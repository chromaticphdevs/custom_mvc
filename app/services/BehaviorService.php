<?php
    namespace Services;
    use Services\CommonMetaService;
    load(['CommonMetaService'],SERVICES);

    class BehaviorService
    {
        public $db = null;
        private $userId;

        public function __construct()
        {
            $this->userId = whoIs('id');
            $this->db = \Database::getInstance();
            $this->getReadLikesViews();
        }

        public function getFavoriteGenre() {
            $likes  = $this->results['likes'];
            $reads = $this->results['reads'];

            $long = 'like';
            $longest = $likes;
            $shortest = $reads;

            if(empty($likes) || empty($reads)) {
                return false;
            }
            
            if(count($reads) > count($likes)) {
                $long = 'read';
                $longest = $reads;
                $shortest = $likes;
            }

            foreach($longest as $key => $long) {
                foreach($shortest as $key => $short) {
                    if($long->parent_id == $short->parent_id) {
                        if($long == 'read') {
                            $computation = (($long->total * .78) + ($short->total * .32)) + ($long->total + $short->long);
                        } else {
                            $computation = (($long->total * .32) + ($short->total * .78)) + ($long->total + $short->long);
                        }
                        $long->relevance = $computation;
                    } else {
                        if($long == 'read') {
                            $long->relevance = $long->total;
                        }else{
                            $long->relevance = $short->total;
                        }
                    }
                }
            }
        }

        public function getReadLikesViews() {
            $like = CommonMetaService::CATALOG_LIKE;
            $read = CommonMetaService::CATALOG_READ;
            $view = CommonMetaService::CATALOG_VIEW;

            $this->db->query(
                "SELECT count(meta_value) as total, parent_id
                    FROM common_meta
                    WHERE meta_key = '{$like}'
                    AND user_id = '{$this->userId}'
                GROUP BY parent_id
                HAVING count(meta_value) > 2
                ORDER BY count(meta_value) desc
                LIMIT 10"
            );
            $likes =  $this->db->resultSet();


            $this->db->query(
                "SELECT count(meta_value) as total, parent_id
                    FROM common_meta
                    WHERE meta_key = '{$read}'
                    AND user_id = '{$this->userId}'
                GROUP BY parent_id
                HAVING count(meta_value) > 1
                ORDER BY count(meta_value) desc
                LIMIT 10"
            );
            $reads =  $this->db->resultSet();

            $this->db->query(
                "SELECT count(meta_value) as total, parent_id
                    FROM common_meta
                    WHERE meta_key = '{$view}'
                    AND user_id = '{$this->userId}'
                GROUP BY parent_id
                HAVING count(meta_value) > 1
                ORDER BY count(meta_value) desc
                LIMIT 10"
            );

            $view =  $this->db->resultSet();
            
            $this->results = [
                'reads' => $reads,
                'likes' => $likes,
                'views' => $view
            ];

            return $this->results;
        }
    }