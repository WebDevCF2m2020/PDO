SELECT  a.* , u.thename
FROM articles a
	INNER JOIN users u
    ON a.users_idusers = u.idusers
 ORDER BY a.thedate DESC;   