--Querry 
INSERT INTO clients(clientFirstName,clientLastName,clientEmail,clientPassword,commends)
VALUES ('Tony','Stark','tony@starkent.com','Iam1ronM@n','i am the real Ironman');


--Querry 2
UPDATE clients SET clientLevel=3 
WHERE clientFirstName = 'Tony'
AND clientLastName='Stark';

--Querry 3
UPDATE inventory 
SET invDescription=replace('gives you the small interiors','small interiors','spacious interior ')
WHERE invMake='GM' AND invModel='Hummer';

--Querry 4
SELECT invModel,classificationName  FROM inventory 
INNER JOIN carclassification 
ON inventory.classificationId=carclassification.classificationId
WHERE classificationName='SUV';

--Querry 5
DELETE FROM inventory
WHERE invModel='Wrangler' 
AND invMake='Jeep';


--Querry 6
UPDATE inventory 
SET invThumbnail=CONCAT('/phpmotors',invThumbnail),
invImage=CONCAT('/phpmotors',invImage);
