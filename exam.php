<?php 
    require_once"function/DBConnectionHandler.php";

    $serverName = "140.127.74.201:9001";
    $userName = "root";
    $password = "root";
    $db = 'bigdata';

    DBConnectionHandler::setConnection(
            $serverName,
            $userName,
            $password,
            $db
    );
    $connection = DBConnectionHandler::getConnection();

    //1-1
    $sql = "SELECT COUNT(DISTINCT dp001_review_sn) AS result 
            FROM edu_bigdata_imp1 
            WHERE PseudoID = :ID
        ";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':ID', 39);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

    //1-2
    $sql = "SELECT COUNT(DISTINCT dp001_review_sn) AS result 
            FROM edu_bigdata_imp1 
            WHERE PseudoID = :ID AND dp001_question_sn != :VAL
        ";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':ID', 39);
    $stmt->bindValue(':VAL', 'NA');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

    //2-1
    $sql = "SELECT DISTINCT dp001_video_item_sn 
            FROM edu_bigdata_imp1 
            WHERE PseudoID = :ID
            GROUP BY dp001_video_item_sn
        ";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':ID', 281);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

    //2-2
    $sql = "SELECT COUNT(dp001_prac_score_rate) AS result 
            FROM edu_bigdata_imp1 
            WHERE PseudoID = :ID AND dp001_prac_score_rate = 100
        ";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':ID', 281);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

    //3-1
    $sql = "SELECT COUNT(dp001_record_plus_view_action) AS result  
            FROM edu_bigdata_imp1 
            WHERE PseudoID = :ID AND dp001_record_plus_view_action = :VAL
        ";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':ID', 71);
    $stmt->bindValue(':VAL', 'pasued');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

    //3-2
    $sql = "SELECT DISTINCT DATE(dp001_review_start_time), DATE(dp001_review_end_time)
            FROM edu_bigdata_imp1 
            WHERE PseudoID = :ID
            GROUP BY dp001_review_start_time, dp001_review_end_time
        ";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':ID', 71);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

    //4-1
    $sql = "SELECT dp001_review_sn, MAX(review_count) review_count
            FROM
            (
                SELECT dp001_review_sn, COUNT(dp001_review_sn) AS review_count 
                FROM edu_bigdata_imp1 
                GROUP BY dp001_review_sn  
            )AS arr
            GROUP BY dp001_review_sn
        ";
    $stmt = $connection->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

    //4-2
    $sql = "SELECT COUNT(dp002_extensions_alignment) AS result  
            FROM edu_bigdata_imp1 
            WHERE dp002_extensions_alignment = :VAL
        ";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':VAL', '十二年國民教育類');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

    //4-3
    $sql = "SELECT dp002_verb_display_zh_TW
            FROM
            (
                SELECT dp002_verb_display_zh_TW, COUNT(dp002_verb_display_zh_TW) AS count 
                FROM edu_bigdata_imp1 
                WHERE dp002_verb_display_zh_TW = :VAL
                GROUP BY dp002_verb_display_zh_TW  
                ORDER BY count DESC
                LIMIT 3
            )AS arr
            GROUP BY dp002_verb_display_zh_TW
        ";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':VAL', 'NA');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);
    
    //4-4
    $sql = "SELECT COUNT(dp002_extensions_alignment) AS result  
            FROM edu_bigdata_imp1 
            WHERE dp002_extensions_alignment = :VAL
        ";
    $stmt = $connection->prepare($sql);
    $stmt->bindValue(':VAL', '校園職業安全');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($result);

    