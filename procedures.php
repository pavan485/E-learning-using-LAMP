<?php
DROP FUNCTION IF EXISTS register_student;
delimiter $$
CREATE FUNCTION register_student(email varchar(50),phone_number bigint,gender enum('Male','Female'),date_of_birth date,password varchar(50))
RETURNS int
DETERMINISTIC
BEGIN
declare eid varchar(50);
declare ret int;
select student_email into eid from student_details where student_email=email;
if(strcmp(email,eid)=0) then
	set ret = 1;
else
	INSERT INTO student_details (student_email,phone_number,gender,date_of_birth,password) values(email,phone_number,gender,date_of_birth,password);
	set ret =0;
end if;
return ret;
END;
$$
DELIMITER ;
SELECT register_student ('siva@gmail.com',9848856844,'Male',15-10-1998,'gOOff11$') as id;
?>


delete from enrolled_courses where student_email='siva@gmail.co.in' limit 2;

 select * from enrolled_courses;

start in(select start_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email))
			or enddate in (select start_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email))
				
insert into enrolled_courses (student_email,course_id,start_date) values ('Nirmala.Joshi@dl.com',1002,2021-05-04);

    DECLARE ed Date;
    DECLARE ad Date;
,end_date into ed,date_add(end_date,interval 1 day) as assessment_date into ad 
?>
drop table c;
create table c(
select start_date,end_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email='siva@gmail.co.in') and start_date in (select start_date from enrolled_courses where student_email='siva@gmail.co.in')
);
select (curdate() <= Start_Date and curdate() >= End_Date) as DateInRange from c;
create table d(select ((start < Start_Date and start > End_Date) or (enddate < Start_Date and enddate > End_Date)) as DateInRange from c);



<?php
DROP PROCEDURE IF EXISTS enroll_course;
DELIMITER //
CREATE PROCEDURE enroll_course(in cid int, in start date,in enddate date,in email varchar(50),in test varchar(10),OUT status varchar(100))
BEGIN 
    DECLARE output varchar(50);
    DECLARE num INT;
    DECLARE i INT;
    DECLARE j INT;
    DECLARE h INT;
    DECLARE a INT;
    DECLARE assessment date;
    DECLARE sd date;
    DECLARE ed date;
	SET assessment = DATE_ADD(enddate, INTERVAL 1 DAY);
    SELECT COUNT(*) INTO num FROM enrolled_courses WHERE student_email=email;
    IF num >= 3 THEN
        SET status="You have enrolled the maximum limit of  3 courses!";
    ELSE
		select count(*) into h from enrolled_courses where student_email=email and (start_date=start and course_id=cid);
		if h!=0 then
			SET status="You Have Already Enrolled For This Course";
			
		else
			select count(*) into i from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email);
			set j=0;
			set a=0;
			while (j<i) do
			if ((start > (select start_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email) limit j,1))
				and (start < (select end_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email)limit j,1))) or 
				((enddate > (select start_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email)limit j,1))
				and (enddate < (select end_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email)limit j,1))) or 
				((assessment > (select start_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email)limit j,1))
				and (assessment < (select end_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email)limit j,1))) then
				set a=1;
			end if;
			set j=j+1;
			end while;
			if a then
				SET status="Dates conflicting with already enrolled course";
			elseif (test='no') then
				insert into enrolled_courses (student_email,course_id,start_date) values (email,cid,start);
				SET status="Course enrolled successfully";
				update scheduled_courses set participant_limit=participant_limit-1 where start_date=start and course_id=cid;
			elseif (test='yes') then
				insert into enrolled_courses(student_email,course_id,start_date,assessment_date) values(email,cid,start,assessment);
				SET status="Course enrolled successfully";
				update scheduled_courses set participant_limit=participant_limit-1 where start_date=start and course_id=cid;
			end if;
		end if;

    END IF;
END;
//
DELIMITER ;



CALL enroll_course (1003,'2021-05-14','2021-05-15','siva@gmail.co.in','no',@output);
SELECT @output;
?>























<?php

DROP PROCEDURE IF EXISTS enroll_course;
DELIMITER //
CREATE PROCEDURE enroll_course(in course_id int, in start date,in enddate date,in email varchar(50),in test varchar(10),OUT status varchar(100))
BEGIN 
    DECLARE output varchar(50);
    DECLARE num INT;
    DECLARE sd date;
    DECLARE ed date;
    DECLARE assessment date;
	SET assessment = DATE_ADD(enddate, INTERVAL 1 DAY);
	DEClARE daterange CURSOR FOR select start_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email);
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET finished = 1;
    SELECT COUNT(*) INTO num FROM enrolled_courses WHERE student_email=email;
    IF num >= 3 THEN
        SET status="You have enrolled the maximum limit of  3 courses!";
    ELSE
		OPEN daterange;
		getdates: Loop
		fetch daterange into sd
		if then
			SET status="Dates conflicting with already enrolled course";
		elseif (test='no') then
			insert into enrolled_courses (student_email,course_id,start_date) values (email,course_id,start);
			SET status="Course enrolled successfully no";
		elseif (test='yes') then
			insert into enrolled_courses(student_email,course_id,start_date,assessment_date) values(email,course_id,start,assessment);
			SET status="Course enrolled successfully yes";	
		end if;
    END IF;
END;
//
DELIMITER ;

CALL enroll_course (1004,'2021-05-06','2021-05-12','Sid_developer@learn.co.in','yes',@output);
SELECT @output;

DROP PROCEDURE IF EXISTS cursor_ROWPERROW;
DELIMITER ;;

?>

<?php
DROP PROCEDURE IF EXISTS enroll_course;
DELIMITER //
CREATE PROCEDURE enroll_course(in course_id int, in start date,in enddate date,in email varchar(50),in test varchar(10),OUT status varchar(100))
BEGIN 
    DECLARE output varchar(50);
    DECLARE num INT;
    DECLARE assessment date;
	SET assessment = DATE_ADD(enddate, INTERVAL 1 DAY);
	
    SELECT COUNT(*) INTO num FROM enrolled_courses WHERE student_email=email;
    IF num >= 3 THEN
        SET status="You have enrolled the maximum limit of  3 courses!";
    ELSE
		drop table c;
		create table c(select start_date,end_date from scheduled_courses where course_id in (select course_id from enrolled_courses where student_email=email) and start_date in (select start_date from enrolled_courses where student_email=email));
		drop table d;
		create table de(select (start < Start_Date and start > End_Date) or (enddate < Start_Date and enddate > End_Date) as DateInRange from c);
		if 1 in (select * from de) then
			SET status="Dates conflicting with already enrolled course";
		elseif (test='no') then
			insert into enrolled_courses (student_email,course_id,start_date) values (email,course_id,start);
			SET status="Course enrolled successfully no";
		elseif (test='yes') then
			insert into enrolled_courses(student_email,course_id,start_date,assessment_date) values(email,course_id,start,assessment);
			SET status="Course enrolled successfully yes";	
		end if;
    END IF;
END;
//
DELIMITER ;



CALL enroll_course (1005,'2021-05-10','2021-05-12','siva@gmail.co.in','no',@output);
SELECT @output;
?>