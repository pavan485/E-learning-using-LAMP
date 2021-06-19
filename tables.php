Table 1 : student_details

create table student_details(
student_email varchar(50) not null primary key,
phone_number bigint not null,
gender enum ('Male','Female') not null,
date_of_birth DATE not null,
password varchar(20) not null)engine=innodb;

Table 2 : trainer_details

create table trainer_details(
trainer_email varchar(25) not null primary key,
phone_number bigint not null,
experience float not null,
skill_set varchar(100) not null,
job_level int not null default 1,
salary float not null,
password varchar(20) not null default 'Elearn@123')engine=innodb;

Table 3 : course_details

create table course_details(
course_id int not null primary key AUTO_INCREMENT,
course_name varchar(50) not null,
duration int not null default 1)AUTO_INCREMENT=1000 engine=innodb;

Table 4 : scheduled_courses

create table scheduled_courses(
course_id int not null,
start_date Date not null,
end_date date not null,
trainer_email varchar(20) not null references trainer_details (trainer_email),
assessment_status enum('Yes','No') not null default 'No',
participant_limit int not null default 10,
no_of_questions int default 0,primary key (course_id,start_date))engine=innodb;

Table 5 : enrolled_courses

create table enrolled_courses(
enrollment_id int not null primary key AUTO_INCREMENT,
student_email varchar(50) not null REFERENCES student_details (student_email),
course_id int not null REFERENCES scheduled_courses (course_id),
start_date date not null REFERENCES scheduled_courses (start_date),
marks_secured int default NULL,
assessment_date date default NULL) AUTO_INCREMENT=0 engine=innodb;
 
Table 6 : question_generation_details

create table question_generation_details(
question_id varchar(20) not null primary key,
course_id int not null REFERENCES course_details(course_id),
author_email varchar(20) not null REFERENCES trainer_details (trainer_email),
reviewer_email varchar(20) not null REFERENCES trainer_details (trainer_email),
status enum('Initiated','Saved','Submitted','Accepted','Rejected','Deleted') not null,
reviewer_comments text default Null,
author_comments text default NULL)engine=innodb;

Table 7 : question_bank

create table question_bank(
question_id varchar(20) not null primary key REFERENCES question_generation_details (question_id),
question_description text not null,
code text,
category enum('single','multiple') not null default 'single',
options text not null,
answer varchar(100) not null)engine=innodb;


Table 9 for user answers:
create table answers(
question_id varchar(50) primary key REFERENCES question_bank (question_id),
useranswers varchar(50)) engine=innodb;


drop table student_details;
drop table trainer_details;
drop table course_details;
drop table scheduled_courses;
drop table enrolled_courses;
drop table question_generation_details;
drop table question_bank;


select distinct c.course_name,date_add(end_date,interval 1 day) as assessment_date,
no_of_questions,no_of_questions*5 as marks,
no_of_questions*2 as duration from scheduled_courses sc inner join course_details c on sc.course_id=c.course_id 
inner join enrolled_courses ec on c.course_id=ec.course_id WHERE sc.assessment_status='yes' and 
(sc.start_date in (select start_date from enrolled_courses where student_email='".$user."')  
and sc.course_id in (select course_id from enrolled_courses where student_email='".$user."'));


select course_name, DATE_FORMAT(start_date,'%d-%b-%Y') as start_date,DATE_FORMAT(end_date,'%d-%b-%Y') as end_date, assessment_status, substring_index(trainer_email,'@',1) as trainer_email,participant_limit from course_details, scheduled_courses where course_details.course_id=scheduled_courses.course_id and DATE_FORMAT(start_date,'%d-%b-%Y')>DATE_FORMAT(now(),'%d-%b-%Y')order by DATE_FORMAT(start_date,'%d-%b-%Y'),participant_limit ASC LIMIT 3;





select
select enrollment_id from enrolled_courses where course_id in (select course_id from course_details where course_name='python')and (start_date='2021-04-21' and student_email='siva@gmail.co.in');