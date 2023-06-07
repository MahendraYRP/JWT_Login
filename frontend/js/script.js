document.getElementById('employeeForm').addEventListener('submit', function(event) {
    event.preventDefault();
  
    // Get form values
    var name = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var phone_number = document.getElementById('phone_number').value;
    var salary = document.getElementById('salary').value;
    var gender = document.getElementById('gender').value;
    var address = document.getElementById('address').value;
    var city = document.getElementById('city').value;
    var state = document.getElementById('state').value;
    var pin_code = document.getElementById('pin_code').value;
  
    
    var employee = {
      "name": name,
      "email": email,
      "phone_number": phone_number,
      "salary": salary,
      "gender": gender,
      "address": address,
      "city": city,
      "state": state,
      "pin_code": pin_code
    };
  
    // Send POST request to the API
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/php_project/api_jwt/v1/employeesForm.php');
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('Authorization', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2ODU5NTU1ODMsIm5iZiI6MTY4NTk1NTU5MywiZXhwIjoxNjg1OTU3MzgzLCJhdWQiOiJteXVzZXJzIiwiZGF0YSI6eyJpZCI6OCwibmFtZSI6IjEiLCJlbWFpbCI6IjFAZ21haWwuY29tIn19.CL4lt9MUdquw0rtB6Kmoy2tdZxvfOgYN3ZhYfuH932g7DpDbD99Hl4JP30jpnRz1sSqPzXQk17cqIIwoYyf4ZQ');
  
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
          console.log('Employee added successfully!');
        } else {
          console.error('Failed to add employee');
        }
      }
    };
  
    xhr.send(JSON.stringify(employee));
  });
  
