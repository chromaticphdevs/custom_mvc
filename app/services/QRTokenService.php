<?php
    namespace Services;
    use Database;
    use QRcode;
    require_once LIBS.DS.'phpqrcode'.DS.'qrlib.php';
    class QRTokenService {

        const RENEW_ACTION  = 'RENEW_ACTION';
        const CREATE_ACTION = 'CREATE_ACTION';
        const LOGIN_TOKEN = 'LOGIN_TOKEN';

        /**
         * available parameters
         * QR-VALUE
         * QR-LINK
         */
        public static function createQRCODE($params = []) {

        }
        /**
         * qr_name
            path_upload
            image_link
            qr_value
         */
        public static function createIMAGE($params = []) {
            $pathUpload = $params['path_upload'];
            $imageLink = $params['image_link'];
            $qrValue = $params['qr_value'];
            $qrName = $params['qr_name'];

            $pathUpload = $pathUpload.DS.$qrName.'.png';
            $imageLink = $imageLink.'/'.$qrName.'.png';
            $qrValue   = $qrValue.'/'.$qrValue.'.png';


            // dump([
            //     $pathUpload,
            //     $pathURL
            // ]);
            QRcode::png($qrValue, $pathUpload);

            return [
                'qr_path' => $pathUpload,
                'qr_link' => $imageLink,
                'qr_value' => $qrValue
            ];
        }

        public static function getLatestToken($category) {
            $db = Database::getInstance();
            $db->query(
                "SELECT * FROM qr_tokens
                    WHERE category = '$category'
                    ORDER BY id desc"
            );
            return $db->single()->token ?? false;
        }

        public static function getLatest($category) {
            $db = Database::getInstance();
            $db->query(
                "SELECT * FROM qr_tokens
                    WHERE category = '$category'
                    ORDER BY id desc"
            );
            return $db->single() ?? false;
        }

        public static function renewOrCreate($category) {
            require_once LIBS.DS.'phpqrcode'.DS.'qrlib.php';
            $db = Database::getInstance();

            $db->query(
                "SELECT * FROM qr_tokens
                    WHERE category = '$category'"
            );
            $qrToken = $db->single();
            $token = random_number(5);

            $lastQRToken = self::getLatest($category);
            $abspath = base64_decode($lastQRToken->full_path);

            //delete old qr
            if(file_exists($abspath)) {
                unlink($abspath);
            }
            $qrLink = URL.'/api/Authentication/QR_AUTH_LOADER?token='.$token;
            $qrLinkEncoded = base64_encode($qrLink);

            $name = random_number(6).'.png';
            //create new path
            $abspath = PATH_UPLOAD.DS.$name;
            $srcURL = GET_PATH_UPLOAD.'/'.$name;

            QRcode::png($qrLink, $abspath);
            $path = base64_encode($abspath);
            $srcURL = base64_encode($srcURL);

            if (!$qrToken) {
                //create
                $db->query(
                    "INSERT INTO qr_tokens(category,token,full_path, qr_link, src_url)
                        VALUES('{$category}','{$token}','{$path}', '{$qrLinkEncoded}', '{$srcURL}')"
                );
                $db->execute();
            } else {
                //update
                $db->query(
                    "UPDATE qr_tokens
                        SET category = '{$category}', 
                            token = '{$token}', 
                            full_path = '{$path}',
                            qr_link = '{$qrLinkEncoded}',
                            src_url = '{$srcURL}'
                            WHERE category = '{$category}' "
                );
                $db->execute();
            }
        }
    }