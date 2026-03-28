DROP TABLE IF EXISTS tasks;
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_name VARCHAR(100),
  task_category  VARCHAR(100),
  task_priority VARCHAR(6),
  task_due_date CHAR(10),
  task_time FLOAT(3,1),
  task_status BOOLEAN,
  task_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
