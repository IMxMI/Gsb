insert into login (id, login, mdp)
select id, login, mdp
from visiteur;

select * from login;

ALTER TABLE login
ADD type char(3);
