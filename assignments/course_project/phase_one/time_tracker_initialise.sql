CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_name VARCHAR(100),
  task_category  VARCHAR(100),
  task_priority ENUM('Low','Medium','High'),
  task_due_date DATE,
  task_time FLOAT(3,1),
  task_status BOOLEAN,
  subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
