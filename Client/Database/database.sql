create database oauth-client;

create table users (
	id bigserial,
	username character varying(20),
	password character varying(255),
	created timestamp without time zone,
	modified timestamp without time zone,
	primary key (id)
);

insert into users (username, password, created, modified) values ('admin', '$2a$10$zdBPS1gfzZKFk5x.dt/1kOSvQ87XOIsnz8FkRwaY.mE5QIYL7YNje', '2016-01-01 00:00:00', '2016-01-01 00:00:00');
insert into users (username, password, created, modified) values ('user1', '$2a$10$zdBPS1gfzZKFk5x.dt/1kOSvQ87XOIsnz8FkRwaY.mE5QIYL7YNje', '2016-01-01 00:00:00', '2016-01-01 00:00:00');

create table applications (
	id bigserial,
	client_id character varying(20),
	secret character varying(255),
	redirect_url character varying(255),
	user_id bigint,
	created timestamp without time zone,
	modified timestamp without time zone,
	primary key (id)
);

insert into applications (client_id, secret, user_id, created, modified) values ('user1', 'user1', 2, '2016-01-01 00:00:00', '2016-01-01 00:00:00');

create table access_tokens (
	id bigserial,
	application_id bigint,
	resource_owner_id bigint,
	auth_code character varying(50),
	access_token character varying(50),
	token_expiry_date timestamp without time zone,
	created timestamp without time zone,
	modified timestamp without time zone,
	primary key (id)
);
