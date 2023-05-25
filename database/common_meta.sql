create table common_meta(
    id int(10) not null primary key AUTO_INCREMENT,
    parent_id int(10),
    meta_key varchar(50),
    meta_value varchar(100),
    user_id int(10) not null,
    created_at datetime DEFAULT null
);


drop view v_item_meta;

create view v_item_meta as 
    SELECT meta_key as meta_name, sum(meta_value) as total_count, parent_id
    FROM common_meta
    WHERE meta_key in('CATALOG_LIKE', 'CATALOG_READ' ,'CATALOG_VIEW')
    GROUP BY parent_id,meta_key


create view v_comment_meta as 
    SELECT meta_key as meta_name, sum(meta_value) as total_count, parent_id
    FROM common_meta
    WHERE meta_key = 'COMMENT_LIKE'
    GROUP BY parent_id,meta_key
    
    
    


