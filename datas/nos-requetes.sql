SELECT  a.* , u.thename
FROM articles a
	INNER JOIN users u
    ON a.users_idusers = u.idusers
 ORDER BY a.thedate DESC;   
 
 INSERT INTO articles (thetitle,thetext,users_idusers) VALUES('coucou','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer vel dapibus urna, scelerisque gravida lacus. Mauris at ligula purus. Nunc semper semper pellentesque. Duis at magna dapibus, lobortis lectus lacinia, pulvinar leo. Aliquam dignissim tellus nec eros bibendum dapibus. Nunc dapibus urna sit amet tincidunt condimentum. Cras eleifend a tortor at sollicitudin. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nam convallis ligula sed eros consequat, a venenatis mi posuere. Cras dignissim ante a sapien hendrerit, in porttitor ex pellentesque. Maecenas pellentesque ligula et enim pulvinar, vel maximus felis viverra. Vivamus eget ligula nibh. Suspendisse dapibus quam euismod tortor facilisis condimentum. Duis rutrum tortor ut fermentum condimentum. Suspendisse vestibulum sapien est, vitae dignissim libero fringilla in. Phasellus pretium nibh ac enim tincidunt, nec tincidunt lectus tristique.',1);