CREATE DATABASE 

IF NOT EXISTS dbsystem CHARACTER SET utf8 COLLATE utf8_general_ci;

USE dbsystem ;

CREATE TABLE warehouses (

warehouse_id int auto_increment NOT NULL,
warehouse_name varchar(50) NOT NULL,
observation varchar(100) NULL,

PRIMARY KEY(warehouse_id)

)ENGINE = InnoDb; 


CREATE TABLE status (

status_id int auto_increment NOT NULL,
status_name varchar(50) NOT NULL,
PRIMARY KEY(status_id)

)ENGINE = InnoDb;


CREATE TABLE users (

user_id int auto_increment NOT NULL,
warehouse_id int NOT NULL,
status_id int NOT NULL,
name varchar(100) NOT NULL,
username varchar(20) UNIQUE NOT NULL,
email varchar(50) NULL,
password varchar(50) NOT NULL,
created_at date NULL,

PRIMARY KEY (user_id),
CONSTRAINT users_status FOREIGN KEY (status_id) REFERENCES status(status_id),
CONSTRAINT users_warehouses FOREIGN KEY (warehouse_id) REFERENCES warehouses(warehouse_id)

)ENGINE = InnoDb;


CREATE TABLE roles (

rol_id int auto_increment NOT NULL,
rol_name varchar(50) NOT NULL,
PRIMARY KEY (rol_id)

)ENGINE = InnoDb;


CREATE TABLE users_roles (

user_id int NOT NULL,
rol_id int NOT NULL,
CONSTRAINT user_has_roles FOREIGN KEY (user_id) REFERENCES users(user_id),
CONSTRAINT roles_has_user FOREIGN KEY (rol_id) REFERENCES roles(rol_id)

)ENGINE = InnoDb;


CREATE TABLE customers (

customer_id int auto_increment NOT NULL,
user_id int NOT NULL,
customer_name varchar(100) NOT NULL,
email varchar(50) NULL,
telephone1 varchar(20) NULL,
telephone2 varchar(20) NULL,
rnc varchar(20) NULL,
created_at date NOT NULL,
PRIMARY KEY (customer_id),
CONSTRAINT users_customers FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE addresses (

address_id int auto_increment NOT NULL,
user_id int NOT NULL,
street varchar(50) NULL,
province varchar(50) NOT NULL,
zipcode varchar(20) NULL,
PRIMARY KEY (address_id),
CONSTRAINT users_addresses FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE customers_addresses (

customer_id int NOT NULL,
address_id int NOT NULL,

CONSTRAINT customers_addresses FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
CONSTRAINT addresses_customers FOREIGN KEY (address_id) REFERENCES addresses(address_id)

)ENGINE = InnoDb;


CREATE TABLE units (

unit_id int auto_increment NOT NULL,
unit_name varchar(30) NOT NULL,
symbol varchar(10) NULL,

PRIMARY KEY(unit_id)

)ENGINE = InnoDb;


CREATE TABLE products (

product_id int auto_increment NOT NULL,
user_id int NOT NULL,
warehouse_id int NOT NULL,
unit_id int NOT NULL,
status_id int NOT NULL,
product_code varchar(50) UNIQUE NULL,
product_name varchar(85) NOT NULL,
price_in decimal(19,2) NULL,
price_out decimal(19,2) NOT NULL,
quantity decimal(6,2) NOT NULL,
inventary_min int NULL,
expiration date NULL,
created_at date NULL,

PRIMARY KEY (product_id),
CONSTRAINT users_products FOREIGN KEY (user_id) REFERENCES users(user_id),
CONSTRAINT warehouses_products FOREIGN KEY (warehouse_id) REFERENCES warehouses(warehouse_id),
CONSTRAINT units_products FOREIGN KEY (unit_id) REFERENCES units(unit_id),
CONSTRAINT status_products FOREIGN KEY (status_id) REFERENCES status(status_id)

)ENGINE = InnoDb;


CREATE TABLE categories (

category_id int auto_increment NOT NULL,
user_id int NOT NULL,
category_name varchar(45) NOT NULL,
observation varchar(120) NULL,

PRIMARY KEY(category_id),
CONSTRAINT users_categories FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE taxes (

tax_id int auto_increment NOT NULL,
user_id int NOT NULL,
tax_name varchar(25) NOT NULL,
tax_value int NOT NULL,
observation varchar(220) NULL,

PRIMARY KEY(tax_id),
CONSTRAINT users_taxes FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE discounts (

discount_id int auto_increment NOT NULL,
user_id int NOT NULL,
discount_name varchar(50) NOT NULL,
discount_value int NOT NULL,
observation varchar(120) NULL,

PRIMARY KEY(discount_id),
CONSTRAINT users_discounts FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE products_categories (

product_id int NOT NULL,
category_id int NOT NULL,

CONSTRAINT products_categories FOREIGN KEY (product_id) REFERENCES products(product_id),
CONSTRAINT categories_products FOREIGN KEY (category_id) REFERENCES categories(category_id)

)ENGINE = InnoDb;


CREATE TABLE products_taxes (

product_id int NOT NULL,
tax_id int NOT NULL,

CONSTRAINT products_taxes FOREIGN KEY (product_id) REFERENCES products(product_id),
CONSTRAINT taxes_products FOREIGN KEY (tax_id) REFERENCES taxes(tax_id)

)ENGINE = InnoDb;


CREATE TABLE products_discounts (

product_id int NOT NULL,
discount_id int NOT NULL,

CONSTRAINT products_discounts FOREIGN KEY (product_id) REFERENCES products(product_id),
CONSTRAINT discounts_products FOREIGN KEY (discount_id) REFERENCES discounts(discount_id)

)ENGINE = InnoDb;


CREATE TABLE price_lists (

list_id int auto_increment NOT NULL,
user_id int NOT NULL,
list_name varchar(50) NOT NULL,
list_value int NOT NULL,
observation varchar(150) NULL,

PRIMARY KEY(list_id),
CONSTRAINT price_lists_users FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE products_price_lists  (

list_id int NOT NULL,
product_id int NOT NULL,

CONSTRAINT products_price_lists FOREIGN KEY (product_id) REFERENCES products(product_id),
CONSTRAINT price_lists_products FOREIGN KEY (list_id) REFERENCES price_lists(list_id)

)ENGINE = InnoDb;


CREATE TABLE type_item_settings (

type_item_setting_id int auto_increment NOT NULL,
user_id int NOT NULL,
item_setting_name varchar(50) NOT NULL,

PRIMARY KEY(type_item_setting_id),
CONSTRAINT type_item_settings_users FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE item_settings (

item_setting_id int auto_increment NOT NULL,
user_id int NOT NULL,
warehouse_id int NOT NULL,
total_setting decimal(19,2) NOT NULL,
observation varchar(120) NULL,
created_at date NOT NULL,

PRIMARY KEY(item_setting_id),
CONSTRAINT item_settings_users FOREIGN KEY (user_id) REFERENCES users(user_id),
CONSTRAINT item_settings_warehouses FOREIGN KEY (warehouse_id) REFERENCES warehouses(warehouse_id)

)ENGINE = InnoDb;


CREATE TABLE item_setting_details  (

item_setting_detail_id int auto_increment NOT NULL,
item_setting_id int NOT NULL,
type_item_setting_id int NOT NULL,
product_id int NOT NULL,
previous_cost decimal(19,2) NOT NULL,
price_in decimal(19,2) NOT NULL,
setting_quantity decimal(6,2) NOT NULL,

PRIMARY KEY(item_setting_detail_id),
CONSTRAINT products_item_setting_details FOREIGN KEY (product_id) REFERENCES products(product_id),
CONSTRAINT item_setting_details_item_settings FOREIGN KEY (item_setting_id) REFERENCES item_settings(item_setting_id),
CONSTRAINT item_setting_details_type_item_settings FOREIGN KEY (type_item_setting_id) REFERENCES type_item_settings(type_item_setting_id)

)ENGINE = InnoDb;


CREATE TABLE payment_methods (

payment_method_id int auto_increment NOT NULL,
user_id int NOT NULL,
payment_name varchar(45) NOT NULL,

PRIMARY KEY(payment_method_id),
CONSTRAINT users_payment_methods FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE invoices (

invoice_id int auto_increment NOT NULL,
noinvoice varchar(11) unique NOT NULL,
warehouse_id int NOT NULL,
payment_method_id int NOT NULL,
status_id int NOT NULL,
customer_id int NOT NULL,
user_id int NOT NULL,
total_invoice decimal(19,2) NOT NULL,
money_received decimal(19,2) NULL,
pending decimal(19,2) NULL,
expiration date NULL,
created_at date NOT NULL,

PRIMARY KEY(invoice_id),
CONSTRAINT warehouses_invoices FOREIGN KEY (warehouse_id) REFERENCES warehouses(warehouse_id),
CONSTRAINT customers_invoices FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
CONSTRAINT payment_methods_invoices FOREIGN KEY (payment_method_id) REFERENCES payment_methods(payment_method_id),
CONSTRAINT invoices_status FOREIGN KEY (status_id) REFERENCES status(status_id),
CONSTRAINT users_invoices FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE payments (

payment_id int auto_increment NOT NULL,
user_id int NOT NULL,
customer_id int NOT NULL,
invoice_id int NOT NULL,
payment_method_id int NOT NULL,
warehouse_id int NOT NULL,
received decimal(19,2) NOT NULL,
note varchar(150) NULL,
created_at date NOT NULL,

PRIMARY KEY(payment_id),
CONSTRAINT users_payments FOREIGN KEY (user_id) REFERENCES users(user_id),
CONSTRAINT invoices_payments FOREIGN KEY (invoice_id) REFERENCES invoices(invoice_id),
CONSTRAINT warehouses_payments FOREIGN KEY (warehouse_id) REFERENCES warehouses(warehouse_id),
CONSTRAINT customers_payments FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
CONSTRAINT payment_methods_payments FOREIGN KEY (payment_method_id) REFERENCES payment_methods(payment_method_id)

)ENGINE = InnoDb;


CREATE TABLE invoice_detail (

invoice_detail_id int auto_increment NOT NULL,
product_id int NOT NULL,
invoice_id int NOT NULL,
user_id int NOT NULL,
total_quantity decimal(6,2) NOT NULL,
total_price decimal(19,2) NOT NULL,
discount int NULL,
tax decimal(19,2) NULL,
created_at date NOT NULL,

PRIMARY KEY(invoice_detail_id),
CONSTRAINT products_invoice_detail FOREIGN KEY (product_id) REFERENCES products(product_id),
CONSTRAINT invoices_invoice_detail FOREIGN KEY (invoice_id) REFERENCES invoices(invoice_id),
CONSTRAINT users_invoice_detail FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE temp_detail (

temp_detail_id int auto_increment NOT NULL,
product_id int NOT NULL,
user_id int NOT NULL,
total_quantity decimal(6,2) NOT NULL,
total_price decimal(19,2) NOT NULL,
discount decimal(19,2) NOT NULL,
tax decimal(6,2) NULL,

PRIMARY KEY(temp_detail_id),
CONSTRAINT products_temp_detail FOREIGN KEY (product_id) REFERENCES products(product_id),
CONSTRAINT users_temp_detail FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE services (

service_id int auto_increment NOT NULL,
user_id int NOT NULL,
status_id int NOT NULL,
service_name varchar(100) NOT NULL,
price int NOT NULL,
observation varchar(150) NULL,

PRIMARY KEY(service_id),
CONSTRAINT users_services FOREIGN KEY (user_id) REFERENCES users(user_id),
CONSTRAINT status_services FOREIGN KEY (status_id) REFERENCES status(status_id)

)ENGINE = InnoDb;


CREATE TABLE  service_invoices (

service_invoice_id int auto_increment NOT NULL,
noinvoice varchar(11) unique NOT NULL,
warehouse_id int NOT NULL,
payment_method_id int NOT NULL,
status_id int NOT NULL,
customer_id int NOT NULL,
user_id int NOT NULL,
total_invoice int NOT NULL,
money_received int NULL,
pending int NULL,
expiration date NULL,
created_at date NOT NULL,

PRIMARY KEY(service_invoice_id),
CONSTRAINT customers_service_invoices FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
CONSTRAINT payment_methods_service_invoices FOREIGN KEY (payment_method_id) REFERENCES payment_methods(payment_method_id),
CONSTRAINT service_invoices_status FOREIGN KEY (status_id) REFERENCES status(status_id),
CONSTRAINT service_invoices_warehouses FOREIGN KEY (warehouse_id) REFERENCES warehouses(warehouse_id),
CONSTRAINT users_service_invoices FOREIGN KEY (user_id) REFERENCES users(user_id)

)ENGINE = InnoDb;


CREATE TABLE service_detail (

service_detail_id int auto_increment NOT NULL,
user_id int NOT NULL,
service_id int NOT NULL,
service_invoice_id int NOT NULL,
total_quantity int NOT NULL,
total_price int NOT NULL,
discount int NULL,
created_at date NOT NULL,

PRIMARY KEY(service_detail_id),
CONSTRAINT users_service_detail FOREIGN KEY (user_id) REFERENCES users(user_id),
CONSTRAINT services_service_detail FOREIGN KEY (service_id) REFERENCES services(service_id),
CONSTRAINT service_invoices_service_detail FOREIGN KEY (service_invoice_id) REFERENCES service_invoices(service_invoice_id)

)ENGINE = InnoDb;
