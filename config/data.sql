use dbsystem;

INSERT INTO status VALUES (null,'Activo');
INSERT INTO status VALUES (null,'Inactivo');
INSERT INTO status VALUES (null,'Anulada');
INSERT INTO status VALUES (null,'Pagada');
INSERT INTO status VALUES (null,'Por cobrar');
INSERT INTO status VALUES (null,'Vencido');



INSERT INTO units VALUES (null,'unidad',null);
INSERT INTO units VALUES (null,'kilogramo','kg');
INSERT INTO units VALUES (null,'gramo','gr');
INSERT INTO units VALUES (null,'libra','lb');
INSERT INTO units VALUES (null,'onzas','oz');


INSERT INTO warehouses values (null,'principal',null);
INSERT INTO warehouses values (null,'mamey',null);
INSERT INTO warehouses values (null,'esperanza',null);

INSERT INTO users VALUES (null,2,1,'Wilmin José Sánchez','admin','wjose260@gmail.com','1234',curdate());
INSERT INTO users VALUES (null,1,1,'Felix Sánchez','paradis666','260@gmail.com','1234',curdate());
INSERT INTO users VALUES (null,1,1,'prueba','user','260@gmail.com','1234',curdate());

INSERT INTO categories values (null,1,'nínguno',null);
INSERT INTO categories values (null,1,'smartphone',null);
INSERT INTO categories values (null,1,'cover',null);
INSERT INTO categories values (null,1,'glass',null);

INSERT INTO taxes VALUES (null,1,'nínguno',0,null);
INSERT INTO taxes VALUES (null,1,'itbis',18,'El Impuesto sobre Transferencias de Bienes
Industrializados y Servicios (ITBIS)');

INSERT INTO discounts VALUES (null,1,'navidad',200,null);

INSERT INTO price_lists VALUES (null,1,'Principal',0,null);
INSERT INTO price_lists VALUES (null,1,'Minimo',5,null);

INSERT INTO customers VALUES (null,1,'Carlos Manuel perez',null,8095896309,null,'40227454424',curdate());
INSERT INTO customers VALUES (null,1,'Domingo Sanchez',null,82928820355,8095896309,'10200015915',curdate());

INSERT INTO type_item_settings VALUES (null,1,'incremento');
INSERT INTO type_item_settings VALUES (null,1,'descremento');

INSERT INTO payment_methods VALUES (null,1,'Contado');
INSERT INTO payment_methods VALUES (null,1,'Cheque');
INSERT INTO payment_methods VALUES (null,1,'Transferencia');