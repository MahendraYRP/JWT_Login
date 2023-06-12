let tbody = document.querySelector('tbody');

        try {
            fetch("http://localhost/php%20project/api_jwt/v1/readEmployee.php")
                .then(response => response.json())
                .then(Empdata => {



                    Empdata.data.forEach(result => {
                        
                        let tr = document.createElement('tr');

                        let td1 = document.createElement('td');
                        td1.append(result.id);

                        let td2 = document.createElement('td');
                        td2.append(result.name);

                        let td3 = document.createElement('td');
                        td3.append(result.email);

                        let td4 = document.createElement('td');
                        td4.append(result.phone_number);   

                        let update = document.createElement('button');
                        update.innerText = "update";
                        update.addEventListener('click',()=>{
                            window.location.href = `UpdateEmployee.html?empId=${result.id}`;
                        })       
                        
                        let br =  document.createElement('br');
                                       
                         tr.appendChild(td1);
                         tr.appendChild(td2);
                         tr.appendChild(td3);
                         tr.appendChild(td4);
                         tr.appendChild(update);
                         tr.appendChild(br);                                          
                         tbody.appendChild(tr);


                    })


                });

        } catch (error) {
            console.error(error)
        }


        fetch("http://localhost/php%20project/api_jwt/v1/readsalary.php")
        .then(response => response.json())
        .then(salarydata => {
            const tableBody = document.querySelector("#salaryTable tbody");
                console.log(salarydata);
            salarydata.data.forEach(entry => {

                const row = document.createElement("tr");
                const idCell = document.createElement("td");
                idCell.textContent = entry.id;

                const salaryCell = document.createElement("td");
                salaryCell.textContent = entry.salary;

                const yearCell = document.createElement("td");
                yearCell.textContent = entry.year;
                
                const userIdCell = document.createElement("td");
                userIdCell.textContent = entry.user_id;

                //button
                let button =  document.createElement('button')
                button.innerHTML = "update";

                 //clickEvent
                 
                button.addEventListener('click',()=>{
                    window.location.href = `updateSalary.html?userId=${entry.id}`;
                })

                row.appendChild(idCell);
                row.appendChild(salaryCell);
                row.appendChild(yearCell);
                row.appendChild(userIdCell);
                row.appendChild(button);
               
               
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.log("Error fetching salary data:", error);
        });