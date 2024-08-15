<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- vue3 -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- mio css -->
     <link href="style.css" rel="stylesheet">
    <title>TodoList</title>
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="todolist">
                <h1>TodoList <i class="fa-solid fa-pencil"></i></h1>
                <div class="card">
                    <ul class="todo">
                        <li  v-for="(task, index) in myList">
                            <div @click="taskDone(index)" class="element">{{task.task}}</div>
                            <div class="btns">
                                <button @click="deleteTask(index)" class="trash">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card input-card">
                    <input @keyup.enter="updateList" v-model="userInput" type="text" placeholder="Inserisci cose da fare">
                    <button @click="updateList"><i class="fa-solid fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
    </div>
    <!-- mio script js -->
    <script src="main.js"></script>
</body>
</html>