----- Dataset for E-Learning application -----


----- Sample Dataset for `student_details` table -----

INSERT INTO `student_details` (`student_email`, `phone_number`, `gender`, `date_of_birth`, `password`) VALUES ('i_amHacker@gmail.com', '7356614440', 'Female', '1998-04-01', 'Hacker%I12');
INSERT INTO `student_details` (`student_email`, `phone_number`, `gender`, `date_of_birth`, `password`) VALUES ('radhika.Raghunath12@sdc.co.in', '8695263500', 'Female', '2000-03-25', '12#Radrag');
INSERT INTO `student_details` (`student_email`, `phone_number`, `gender`, `date_of_birth`, `password`) VALUES ('Nirmala.Joshi@dl.com', '1236547890', 'Female', '1990-07-16', 'JoshiNir*12');
INSERT INTO `student_details` (`student_email`, `phone_number`, `gender`, `date_of_birth`, `password`) VALUES ('AslamKhan@gmail.com', '9895261423', 'Male', '1993-09-04', 'KingKhan@123!!');
INSERT INTO `student_details` (`student_email`, `phone_number`, `gender`, `date_of_birth`, `password`) VALUES ('Sid_developer@learn.co.in', '9632587415', 'Male', '1994-01-20', 'c#nEt00');


----- Sample Dataset for `trainer_details` table -----


INSERT INTO `trainer_details` (`trainer_email`, `phone_number`, `experience`, `skill_set`, `job_level`, `salary`, `password`) VALUES ('RajKumar@elearn.com', '7896541230', '0.5', 'Java,Python', '1', '15000', 'Elearn@123');
INSERT INTO `trainer_details` (`trainer_email`, `phone_number`, `experience`, `skill_set`, `job_level`, `salary`, `password`) VALUES  ('Anubhav.Thyagi@elearn.com', '9988774455', '2.1', 'Java,Python,Cloud Computing', '2', '20000', 'Anuty@123');
INSERT INTO `trainer_details` (`trainer_email`, `phone_number`, `experience`, `skill_set`, `job_level`, `salary`, `password`) VALUES  ('George.J@elearn.com', '8800256314', '8', 'Java,Python,Cloud Computing', '4', '30000', 'Gj2we34');
INSERT INTO `trainer_details` (`trainer_email`, `phone_number`, `experience`, `skill_set`, `job_level`, `salary`, `password`) VALUES  ('Gayatri.K@elearn.com', '8869302500', '0', 'Current Affairs', '1', '15000', '#Elearn123');
INSERT INTO `trainer_details` (`trainer_email`, `phone_number`, `experience`, `skill_set`, `job_level`, `salary`, `password`) VALUES  ('Manasi.Mahesh@elearn.com', '9685412300', '15', 'Current Affairs,Political Science', '5', '35000', 'Mm3@d');


----- Sample Dataset for `course_details` table -----


INSERT INTO `course_details` (`course_name`, `duration`) VALUES ('Java', '3');
INSERT INTO `course_details` (`course_name`, `duration`) VALUES  ('Python', '5');
INSERT INTO `course_details` (`course_name`, `duration`) VALUES  ('Cloud Computing', '1');
INSERT INTO `course_details` (`course_name`, `duration`) VALUES ('Current Affairs', '7');
INSERT INTO `course_details`  (`course_name`, `duration`)VALUES  ('Environmental Science', '9');
INSERT INTO `course_details`   (`course_name`, `duration`)VALUES  ('Political Science', '3');


----- Sample Dataset for `scheduled_courses` table -----


INSERT INTO `scheduled_courses` (`course_id`, `start_date`, `end_date`, `trainer_email`, `assessment_status`, `participant_limit`, `no_of_questions`) VALUES ('1001', '2021-04-21', '2021-04-23', 'RajKumar@elearn.com', 'Yes', '45', '5');
INSERT INTO `scheduled_courses` (`course_id`, `start_date`, `end_date`, `trainer_email`, `assessment_status`, `participant_limit`, `no_of_questions`) VALUES ('1004', '2021-04-20', '2021-04-26', 'Gayatri.K@elearn.com', 'No', '35', NULL);
INSERT INTO `scheduled_courses` (`course_id`, `start_date`, `end_date`, `trainer_email`, `assessment_status`, `participant_limit`, `no_of_questions`) VALUES ('1001', '2021-04-29', '2021-05-01', 'Anubhav.Thyagi@elearn.com', 'Yes', '40', '5');
INSERT INTO `scheduled_courses` (`course_id`, `start_date`, `end_date`, `trainer_email`, `assessment_status`, `participant_limit`, `no_of_questions`) VALUES ('1001', '2021-04-30', '2021-05-02', 'RajKumar@elearn.com', 'Yes', '40', '4');
INSERT INTO `scheduled_courses` (`course_id`, `start_date`, `end_date`, `trainer_email`, `assessment_status`, `participant_limit`, `no_of_questions`) VALUES ('1002', '2021-05-04', '2021-05-08', 'RajKumar@elearn.com', 'No', '58', NULL);
INSERT INTO `scheduled_courses` (`course_id`, `start_date`, `end_date`, `trainer_email`, `assessment_status`, `participant_limit`, `no_of_questions`) VALUES ('1004', '2021-05-06', '2021-05-12', 'Gayatri.K@elearn.com', 'No', '54', NULL);
INSERT INTO `scheduled_courses` (`course_id`, `start_date`, `end_date`, `trainer_email`, `assessment_status`, `participant_limit`, `no_of_questions`) VALUES ('1005', '2021-05-10', '2021-05-12', 'Manasi.Mahesh@elearn.com', 'No', '53', NULL);
INSERT INTO `scheduled_courses` (`course_id`, `start_date`, `end_date`, `trainer_email`, `assessment_status`, `participant_limit`, `no_of_questions`) VALUES ('1003', '2021-05-14', '2021-05-15', 'Anubhav.Thyagi@elearn.com', 'No', '41', NULL);


----- Sample Dataset for `enrolled_courses` table -----


INSERT INTO `enrolled_courses` (`student_email`, `course_id`, `start_date`, `marks_secured`, `assessment_date`) VALUES ( 'Sid_developer@learn.co.in', '1001', '2021-04-21', '20', '2021-04-24');
INSERT INTO `enrolled_courses` (`student_email`, `course_id`, `start_date`, `marks_secured`, `assessment_date`) VALUES ( 'radhika.Raghunath12@sdc.co.in', '1001', '2021-04-21', '5', '2021-04-24');
INSERT INTO `enrolled_courses` (`student_email`, `course_id`, `start_date`, `marks_secured`, `assessment_date`) VALUES ( 'Nirmala.Joshi@dl.com', '1001', '2021-04-21', NULL, '2021-04-24');
INSERT INTO `enrolled_courses` (`student_email`, `course_id`, `start_date`, `marks_secured`, `assessment_date`) VALUES ( 'AslamKhan@gmail.com', '1004', '2021-04-20', NULL, NULL);
INSERT INTO `enrolled_courses` (`student_email`, `course_id`, `start_date`, `marks_secured`, `assessment_date`) VALUES ( 'Sid_developer@learn.co.in', '1002', '2021-05-04', NULL, NULL);
INSERT INTO `enrolled_courses` (`student_email`, `course_id`, `start_date`, `marks_secured`, `assessment_date`) VALUES ( 'Sid_developer@learn.co.in', '1006', '2021-05-10', NULL, NULL);
INSERT INTO `enrolled_courses` (`student_email`, `course_id`, `start_date`, `marks_secured`, `assessment_date`) VALUES ( 'radhika.Raghunath12@sdc.co.in', '1001', '2021-04-30', NULL, '2021-05-03');
INSERT INTO `enrolled_courses` (`student_email`, `course_id`, `start_date`, `marks_secured`, `assessment_date`) VALUES ( 'Sid_developer@learn.co.in', '1003', '2021-05-14', NULL, NULL);


----- Sample Dataset for `question_generation_details` table -----


INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1001', '1001', 'Anubhav.Thyagi@elearn.com', 'George.J@elearn.com', 'accepted', NULL, NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1002', '1001', 'Anubhav.Thyagi@elearn.com', 'George.J@elearn.com', 'accepted', 'Question nee to be rephrased','Question Modified');
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1003', '1001', 'Anubhav.Thyagi@elearn.com', 'George.J@elearn.com', 'accepted', NULL, NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1004', '1001', 'RajKumar@elearn.com', 'George.J@elearn.com', 'accepted', NULL, NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1005', '1001', 'RajKumar@elearn.com', 'George.J@elearn.com', 'accepted', 'Please change the options.Option given is wrong', NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1006', '1001', 'RajKumar@elearn.com', 'George.J@elearn.com', 'accepted', NULL, NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1007', '1002', 'RajKumar@elearn.com', 'George.J@elearn.com', 'saved', NULL, NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1008', '1002', 'RajKumar@elearn.com', 'George.J@elearn.com', 'submitted', NULL, NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1009', '1004', 'Gayatri.K@elearn.com', 'Manasi.Mahesh@elearn.com', 'rejected', 'change options', NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1010', '1004', 'Gayatri.K@elearn.com', 'Manasi.Mahesh@elearn.com', 'deleted', NULL, NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1011', '1003', 'Anubhav.Thyagi@elearn.com', 'George.J@elearn.com', 'rejected', 'Give Correct Answer', NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1012', '1004', 'Gayatri.K@elearn.com', 'Manasi.Mahesh@elearn.com', 'initiated', NULL, NULL);
INSERT INTO `question_generation_details` (`question_id`, `course_id`, `author_email`, `reviewer_email`, `status`, `reviewer_comments`, `author_comments`) VALUES ('Q1013', '1004', 'Gayatri.K@elearn.com', 'Manasi.Mahesh@elearn.com', 'initiated', NULL, NULL);


----- Sample Dataset for `question_bank` table -----


INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1001', 'Java is short for "JavaScript".True of False?', NULL, 'Single', 'True~False', 'A');
INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1002', 'what is the output', 'int arr[] = {10, 20, 30, 40, 50};\nfor(int i=0; i < arr.length; i++)\n{\nSystem.out.print(arr[i]);\n}','Single','10 20 30 40 50~Error~10 20 30','A');
INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1003', 'Which is correct?','\nCustomer a=new Customer();\n new Customer=a();\n new a=Customer();\n Customer a()=new Customer();\n', 'Single', 'A~B~C~D', 'A');
INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1004', 'How commets are written',NULL, 'Multiple', '//~/~/* */~<!-- --!>', 'A~C');
INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1005', 'Which are the properties of Java',NULL, 'Multiple', 'Object Oriented~Secure~Procedure Oriented~Low level', 'A~B');
INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1006', 'How arrays are created in java?',NULL, 'Multiple', 'int Array[];~int[] Array;~int array int[];~int[] array int;', 'A~B');
INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1007', 'What is the output of the following code?', 'print 9//2', 'Single', '4.5~4.0~4~Error\r\n', 'D');
INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1008', 'what is the output','floor(2.9)', 'single', '2~3', 'A');
INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1009','which of the company launched plasma bot?', NULL, 'Single', 'apple~microsoft~google', 'B');
INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1010',  'which body framed the constitution of independant india?', NULL, 'Single', 'drafting committe~constituent Assembly~working committe~union constitution commite', 'A');
INSERT INTO `question_bank` (`question_id`, `question_description`, `code`, `category`, `options`, `answer`) VALUES ('Q1011', 'Which of the following are types of cloud?', NULL, 'Multiple', 'Private~Public~ Protected~Hybrid', 'A~B');