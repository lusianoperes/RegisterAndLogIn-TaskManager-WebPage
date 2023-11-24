$(document).ready(function () {


    const currentPage = window.location.pathname;
    window.addEventListener('pageshow', chequeo());
    function chequeo() {
        if (currentPage == "/~seis/" || currentPage == "/~seis/index.html") {
            permisos();
            fetchTasks();
        }
        if (currentPage == "/~seis/admin.html") {
            fetchTasksAdmin();
        }

    }

    function permisos() {
        if (document.getElementById('subir')) {
            if (JSON.parse(localStorage.getItem('userid')) === null) {
                document.getElementById('subir').classList.add('disabled');
            }
            else {
                document.getElementById('subir').classList.remove('disabled');
                if (localStorage.getItem('userid') == 15) {
                    document.getElementById('adminpage').classList.remove('disabled');
                } else {
                    document.getElementById('adminpage').classList.add('disabled');
                }
            }
        }
    }
    if (document.getElementById('unlog')) {

        document.getElementById('unlog').onclick = function () {
            localStorage.setItem('userid', JSON.stringify(null));
        };
    }

    let edit = false;

    $('#formulario3').submit(function (e) {
        e.preventDefault();
        let postData = {
            username: $('#logusername').val(),
            password: $('#logpasswd').val()
        };
        console.log(postData);
        $.ajax({
            url: 'logeo.php',
            type: 'POST',
            data: postData,
            success: function (response) {
                $('#formulario3').trigger('reset');
                if (response == -1) {
                    alert("La contraseña o nombre de usuario que ha ingresado son incorrectos, por favor vuelvalo a intentar");
                } else {
                    if ((response > 0) == false) /*chequeo de valor NaN*/ {
                        let motivo = `TE FUISTE BANEADO POR EL ADMIN, EL MOTIVO ES: ${response}`;
                        alert(motivo);
                    }
                    else {
                        localStorage.setItem('userid', response);
                        alert("El logeo ha sido exitoso, ya puedes ver y modificar tus tareas guardadas en la pagina principal");
                        window.location.href = "index.html";
                    }

                }
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
            }
        });

    });



    $('#formulario2').submit(function (e) {
        e.preventDefault();
        let postData = {
            username: $('#username').val(),
            password: $('#password').val(),
            email: $('#useremail').val()
        };
        console.log(postData);
        $.ajax({
            url: 'registrar.php',
            type: 'POST',
            data: postData,
            success: function (response) {
                $('#formulario2').trigger('reset');
                if (response == 1) {
                    alert("Ya existe un nombre de usuario o email exactamente igual al ingresado! Seleccione otro");
                } else {
                    window.location.href = "usuarios.html";
                    alert("Registro existoso! Ahora logueese por favor");
                }
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
            }
        });

    });


    $('#formulario').submit(function (e) {
        e.preventDefault();
        let postData = {
            userid: localStorage.getItem('userid'),
            id: $('#id').val(),
            nombre: $('#nombre').val(),
            edad: $('#edad').val(),
            email: $('#email').val(),
            dni: $('#dni').val()
        };
        console.log(postData);

        let url = edit === false ? 'añadir_tarea.php' : 'actualizar_tarea.php';

        $.ajax({
            url: url,
            type: 'POST',
            data: postData,
            success: function (response) {
                edit = false;
                fetchTasks();
                $('#formulario').trigger('reset');
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
            }
        });

    });


    function fetchTasks() {
        let postData = {
            userid: localStorage.getItem('userid')
        };

        $.ajax({
            url: 'traer_tabla.php',
            type: 'POST',
            data: postData,
            success: function (response) {
                let tasks = JSON.parse(response);
                console.log(tasks);
                let template = '';
                tasks.forEach(task => {
                    template += `
                        <tr taskId="${task.id}">
                            <td>
                                <a href="#" class="task-item">${task.nombre}</a>
                            </td>
                            <td>${task.edad}</td>
                            <td>${task.email}</td>
                            <td>${task.dni}</td>
                            <td>
                                <button class="task-delete">
                                    Delete
                                </button>
                            </td>
                        </tr>`;
                });

                $('#all-tasks').html(template);
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
            }
        })
    }

    function fetchTasksAdmin() {
        let postData = {
            userid: localStorage.getItem('userid')
        };

        $.ajax({
            url: 'admin.php',
            type: 'POST',
            data: postData,
            success: function (response) {
                let tasks = JSON.parse(response);
                console.log(tasks);
                let template = '';
                tasks.forEach(task => {
                    if (task.bloqueo == "si") {
                        template += `
                        <tr>
                            <td id = "taskuserid">${task.userid}</td>
                            <td>${task.username}</td>
                            <td>${task.useremail}</td>
                            <td>${task.fecharegistro}</td>
                            <td>${task.ultimoingreso}</td>
                            <td>${task.cantidadingresos}</td>
                            <td>${task.nombre}</td>
                            <td>${task.edad}</td>
                            <td>${task.email}</td>
                            <td>${task.dni}</td>
                            <td>${task.bloqueo}</td>
                            <td>${task.motivo}</td>
                            <td>
                                <button class="task-unblock">
                                    Desbloquear
                                </button>
                            </td>
                        </tr>`;

                    } else if (task.userid != 15) {
                        template += `
                        <tr>
                            <td id = "taskuserid">${task.userid}</td>
                            <td>${task.username}</td>
                            <td>${task.useremail}</td>
                            <td>${task.fecharegistro}</td>
                            <td>${task.ultimoingreso}</td>
                            <td>${task.cantidadingresos}</td>
                            <td>${task.nombre}</td>
                            <td>${task.edad}</td>
                            <td>${task.email}</td>
                            <td>${task.dni}</td>
                            <td>${task.bloqueo}</td>
                            <td>${task.motivo}</td>
                            <td>
                                <button class="task-block">
                                    Bloquear
                                </button>
                            </td>
                        </tr>`;
                    }
                    else {
                        template += `
                        <tr>
                            <td id = "taskuserid">${task.userid}</td>
                            <td>${task.username}</td>
                            <td>${task.useremail}</td>
                            <td>${task.fecharegistro}</td>
                            <td>${task.ultimoingreso}</td>
                            <td>${task.cantidadingresos}</td>
                            <td>${task.nombre}</td>
                            <td>${task.edad}</td>
                            <td>${task.email}</td>
                            <td>${task.dni}</td>
                            <td>${task.bloqueo}</td>
                            <td>${task.motivo}</td>
                            <td></td>
                        </tr>`;

                    }

                });

                $('#all-tasksadmin').html(template);
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
            }
        });

    }

    $(document).on('click', '.task-delete', function (e) {
        if (confirm('Are you sure you want to delete it?')) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('taskId');

            $.ajax({
                url: 'borrar_tarea.php',
                type: 'POST',
                data: { id: id },
                success: function (response) {
                    fetchTasks();
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                }
            });
        }
    });

    $(document).on('click', '.task-block', function (e) {
        if (confirm('Estas seguro de que lo queres banear?')) {
            let userid = this.parentNode.parentNode.querySelector('#taskuserid').textContent;
            var motivo = prompt("Añada el motivo del baneo", "");
            $.ajax({
                url: 'bloquear_usuario.php',
                type: 'POST',
                data: { userid: userid, motivo: motivo },
                success: function (response) {
                    fetchTasksAdmin();
                    alert(response);
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                }
            });
        }
    });

    $(document).on('click', '.task-unblock', function (e) {
        if (confirm('Estas seguro de que lo queres desbanear?')) {
            let userid = this.parentNode.parentNode.querySelector('#taskuserid').textContent;
            $.ajax({
                url: 'desbloquear_usuario.php',
                type: 'POST',
                data: { userid: userid },
                success: function (response) {
                    fetchTasksAdmin();
                    alert(response);
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                }
            });
        }
    });

    $(document).on('click', '.task-item', function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('taskId');
        let postData = { id: id };
        $.ajax({
            url: 'data_click.php',
            type: 'POST',
            data: postData,
            success: function (response) {
                let task = JSON.parse(response);
                console.log(task);
                $('#id').val(task.id);
                $('#nombre').val(task.nombre);
                $('#edad').val(task.edad);
                $('#email').val(task.email);
                $('#dni').val(task.dni);
                edit = true;
            },
            error: function (jqXHR, exception) {
                console.log(jqXHR);
            }
        });
    });

    $('#search').keyup(function (e) {

        let search = $('#search').val();
        let postData = { search: search, userid: localStorage.getItem('userid') };
        if (search) {
            console.log("hl");
            $.ajax({
                url: 'filtrar_tarea.php',
                type: 'POST',
                data: postData,
                success: function (response) {
                    let tasks = JSON.parse(response);
                    console.log(tasks);

                    let template = '';

                    tasks.forEach(task => {
                        template += `<li>${task.nombre}</li>`;
                    });

                    $('#task-result ul').html(template);
                },
                error: function (jqXHR, exception) {
                    console.log(jqXHR);
                }
            });
        }
        else {
            $('#task-result ul').html('');
        }
    });

});

