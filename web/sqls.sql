ALTER TABLE tbl_order_type_rel_accessories ADD CONSTRAINT fk_order_type_rel_id FOREIGN KEY (order_type_rel_id) REFERENCES tbl_order_type_relation(id);
ALTER TABLE tbl_order_type_rel_accessories ADD CONSTRAINT fk_reserve_accessory_id FOREIGN KEY (reserve_accessory_id) REFERENCES  tbl_reserve_accessories(id);