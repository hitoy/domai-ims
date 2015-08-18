Create table ims_message(
	id int auto_increment not null,
	name varchar(100) not null,
	email varchar(100) not null,
	tel varchar(100),
	message text not null,
	company varchar(200),
	product varchar(255),
	country varchar(100),
	url varchar(255),
	lang varchar(10),
	team varchar(50) default "Zhengzhou",
	subtime DATETIME default "1988-04-25 00:00:00",
	msg_status tinyint unsigned default 0,	
	deal_person varchar(50),
	deal_time DATETIME default "1988-04-25 00:00:00",
	ip_add varchar(50) not null,
	http_referer varchar(255),
	user_agent varchar(255),
	PRIMARY KEY(id)
)DEFAULT CHARSET=utf8;
Create table ims_user(
	id int auto_increment not null,
	username varchar(20) not null unique,
	password varchar(40) not null,
	current_stat varchar(10) default "offline",
	userleve tinyint unsigned not null default 1,
	nickname varchar(10) not null,
	lastlogin DATETIME default "1988-04-25 00:00:00",
	lastlogip varchar(50) not null default "0.0.0.0",
	logcount int not null default 1,
	PRIMARY KEY(id)
)DEFAULT CHARSET=utf8;
