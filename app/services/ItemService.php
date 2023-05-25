<?php 
    namespace Services;

    class ItemService {

        public $keywordModel = null;

        public function __construct()
        {   
            if(is_null($this->keywordModel)) {
                $this->keywordModel = model('KeywordModel');
            }
        }

        public function saveKeyword($keyword, $category = 'keyword') {
            $arrayKeyWord = explode('&;', $keyword);
            $genreKeyWord = $keyword;
            $authorKeyword =  $keyword;
            $publisherKeyword = $keyword;

            if(count($arrayKeyWord) > 1) {
                foreach($arrayKeyWord as $key => $row) {
                    if($key == 0) {
                        continue;
                    }

                    $toMatch = explode('=',$row);

                    if($toMatch > 0) {
                        
                        if(empty($toMatch[1])) {
                            continue;
                        }
                        if(isEqual($toMatch[0], ['publishers','publisher','pub'])) {
                            $publisherKeyword = $toMatch[1];
                            $this->keywordModel->store([
                                'category' => 'publishers',
                                'value' => $publisherKeyword
                            ]);
                        }

                        if(isEqual($toMatch[0], ['genre','genres','gen'])) {
                            $genreKeyWord = $toMatch[1];
                            $this->keywordModel->store([
                                'category' => 'genre',
                                'value' => $genreKeyWord
                            ]);
                        }

                        if(isEqual($toMatch[0], ['authors','author','aut'])) {
                            $authorKeyword = $toMatch[1];
                            $this->keywordModel->store([
                                'category' => 'authors',
                                'value' => $genreKeyWord
                            ]);
                        }
                    }
                }
                $mainKeyword = $arrayKeyWord[0];
            } else{
                $mainKeyword = $keyword;
                if(!empty($mainKeyword)) {
                    $this->keywordModel->store([
                        'category' => $category,
                        'value' => $mainKeyword
                    ]);
                }
            }
        }
    }