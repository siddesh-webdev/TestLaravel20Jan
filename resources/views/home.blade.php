<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        table{
            width: 100%;
        }
        th,td{
            border: 1px solid;
            text-align: center;
            padding: 10px;  e
        }
        #createUser{
            padding: 20px;
        }
        #dynamicContent{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* label{
            margin-bottom: 10%;
        } */
    </style>
</head>


<body>
    <div class="container">
        <div class="btnDiv">
            <button id ="createUser">Add User</button>
        </div>
        <div id="dynamicContent">

        </div>
    </div>
</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var htmlData = `<table>
                            <tr>
                                <th>Sr.no</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>`;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "{{url('/users/show')}}", true);
        xhr.responseType = 'json';   
        xhr.onload = function() {  
            if (this.status == 200) {
                var data = xhr.response;
                var i = 1;
                data.forEach((value) => {
                    // console.log(value['name']);
                        htmlData += `<tr>
                                <td>`+i+`</td>
                                <td>`+value['id']+`</td>
                                <td>`+value['name']+`</td>
                                <td>`+value['email']+`</td>
                                <td>`+value['role']+`</td>
                                <td>
                                <button id ="editUser" user_id ="`+value['id']+`" >Edit</button>
                                <button id ="deleteUser" user_id ="`+value['id']+`" >Delete</button>
                                </td>
                        </tr>`;
                        i++;

                });
                
                 htmlData += '</table>'; 
                 document.getElementById("dynamicContent").innerHTML = htmlData;
            }else {
                alert("error");
            } 
        };
        xhr.send();
    }); 

    let createUser = document.getElementById("createUser");
    createUser.addEventListener("click", function() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "{{url('/users/create')}}", true);
        xhr.onload = function() {  
            if (this.status == 200) {
                document.getElementById("dynamicContent").innerHTML = this.responseText;
            }else {
                alert("error");
            } 
        };
        xhr.send();
    });

    document.addEventListener("click", function(e) {
        e.preventDefault();
        if (e.target && e.target.id === "submitUser") {
            let form_id = document.getElementById("addform");
            let data = new FormData();
            data.append('_token', form_id.elements['_token'].value);
            data.append('user_id', form_id.elements['user_id'].value);
            data.append('name', form_id.elements['name'].value);
            data.append('email', form_id.elements['email'].value);
            data.append('role', form_id.elements['role'].value);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "{{url('/users/submit')}}", true);

            xhr.onload = function() {
                if (this.status == 200) {
                    window.location.href = "{{url('/users')}}";
                } else {
                    alert("Error occurred!");
                }
            };
            xhr.onerror = function() {
                alert("Request failed.");
            };
            xhr.send(data);
            }else if(e.target && e.target.id === "deleteUser"){
          
                var user_id = e.target.getAttribute('user_id');
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "{{url('/users/delete')}}", true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onload = function() {
                    if (this.status == 200) {
                        window.location.href = "{{url('/users')}}";
                    } else {
                        alert("Error occurred!");
                    }
                };
                xhr.onerror = function() {
                    alert("Request failed.");
                };
                var data = JSON.stringify({"user_id": user_id,"_token":"{{ csrf_token() }}"});
                xhr.send(data);
            }else if(e.target && e.target.id ==="editUser"){
                var user_id = e.target.getAttribute('user_id');
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "{{url('/users/editUser')}}", true);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.onload = function() {
                    if (this.status == 200) {
                        document.getElementById("dynamicContent").innerHTML = this.responseText;
                    } else {
                        alert("Error occurred!");
                    }
                };
                xhr.onerror = function() {
                    alert("Request failed.");
                };
                var data = JSON.stringify({"user_id": user_id,"_token":"{{ csrf_token() }}"});
                xhr.send(data);
            }
    });

  
    
</script>