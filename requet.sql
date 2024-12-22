CREATE DATABASE chef;
use chef;
create table client (
id int not null PRIMARY KEY AUTO_INCREMENT,
nom varchar(30),
prenom varchar(30),
adress text,
tel text,
email varchar(50) unique,
password text,
RoleId int ,
foreign key(RoleId) references Role(id) on delete cascade
);

SELECT (count(*) - 1) as total  from client;
create table Role(
id int not null PRIMARY KEY AUTO_INCREMENT,
titre varchar(20)
);
insert into role(titre) values("admin");

insert into client(nom,prenom,adress,tel,email,password,RoleId) values("lachhab","asma","Houara","0663501283","asmalachhab66@gmail.com","asma2003",1);

delete from menu where id = 5;
create table menu (
id int not null PRIMARY KEY AUTO_INCREMENT,
nom varchar(20)
);
insert into menu(nom) values("breakfast");
insert into menu(nom) values("lunch");
insert into menu(nom) values("dinner");


create table Plat (
id int not null PRIMARY KEY AUTO_INCREMENT,
nom varchar(30),
ingrediant text,
menuId int,
image text,
FOREIGN KEY (menuId) REFERENCES menu(id) on delete cascade
);
insert into Plat(nom,ingrediant,menuId,image) values("salde nisoise","les pats , sourice , fromage , mayounaise",2,"./image/img1.png");
insert into Plat(nom,ingrediant,menuId,image) values("poulet roti avec de riz","poulet , riz , legume souter",2,"./image/img1.png");
insert into Plat(nom,ingrediant,menuId,image) values("jus de pomme","pomme , banane , ...",2,"./image/img1.png");

insert into Plat(nom,ingrediant,menuId,image) values("dejauner marocain"," , oumlette avec .. , fromage , thé",1,"./image/img1.png");
insert into Plat(nom,ingrediant,menuId,image) values("dejauner american ","dinde fumme , oumlette avec .. , legume souter , viande hache",1,"./image/img1.png");
insert into Plat(nom,ingrediant,menuId,image) values("italian","cafe , pan au chocolat  , ...",1,"./image/img1.png");

SELECT menu.nom , menu.id , Plat.nom,Plat.ingrediant,Plat.image from Plat 
join menu on menu.id = Plat.menuId;




create table Reservation(
id int not null PRIMARY KEY AUTO_INCREMENT,
clientId int,
MenuId int,
dateReservation date,
heur TIME,
nbrPerson int,
status enum ('Anuller','Attent','Confirme') DEFAULT 'Attent',
foreign key(clientId) references client(id) on delete cascade,
foreign key(MenuId) references menu(id)  on delete cascade
);
insert into Reservation(clientId,MenuId,dateReservation,heur,nbrPerson) values(3,2,"2024-12-18","12:00",12);


select client.nom as ClientNom , Reservation.id , menu.nom as MenuNom , Reservation.dateReservation , Reservation.heur , Reservation.nbrPerson , Reservation.status from Reservation 
            join client on client.id = Reservation.clientId 
            join menu on Reservation.MenuId = menu.id;
            
select client.nom as ClientNom , Reservation.id , menu.nom as MenuNom , Reservation.dateReservation , Reservation.heur , Reservation.nbrPerson , Reservation.status , Reservation.clientId , Reservation.MenuId from Reservation 
            join client on client.id = Reservation.clientId 
            join menu on Reservation.MenuId = menu.id;
            
select Reservation.MenuId , menu.nom from menu 
join Reservation on Reservation.MenuId = menu.id;


SELECT count(*) from Reservation where status = 'Attent';


SELECT  menu.nom as MenuName, Plat.nom as PlatName, Plat.ingrediant 
    FROM Plat 
    JOIN menu ON menu.id = Plat.menuId 
    ORDER BY menu.nom;