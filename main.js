const { createApp } = Vue;

createApp({
  data() {
    return {
      // dati utili
      apiUrl: "server.php",
      myList: [],
      userInput: "",
      userInputDescription: "",
    };
  },
  methods: {
    // metodi
    // richiesta axios in post
    getRequest() {
      axios
        .get(this.apiUrl)
        .then((response) => {
          this.myList = response.data;
          console.log(this.myList);
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    },
    // creo un metodo per aggiungere gli elementi ininviati dall'utente alla lista con una richiesta axios in post per mandare i dati al mio server php che ha bisogno di riceverli come se fossero un form quindi utilizzo il metodo header per trasformare i dati come se arrivassero da un form
    updateList() {
      // il dato contenuto in data è come se fosse il value del from che stiamo inviando e la richiesta axios è come se fosse l' action del form
      const data = {
        todoItem: {
          task: this.userInput,
          completed: false,
          description: this.userInputDescription,
        },
      };
      axios
        .post(this.apiUrl, JSON.stringify(data), {
          // headers è un oggetto che specifica che il contenuto inviato è un form
          // headers: { "Content-Type": "multipart/form-data" },
          // per inviare il valore booleano di task completa o no bisogna inviare un file json perchè il form ci strasforma il booleano in stringa
          headers: { "Content-Type": "application/json" },
        })
        .then((response) => {
          console.log(response.data);
          this.myList = response.data;
          this.userInput = "";
          this.userInputDescription = "";
        });
    },
    // metodo per la cancellazione delle task faccio un altra chiamata axios dove gli passo l'indice dell'elemento cliccato dal bottone del cestino
    deleteTask(index) {
      const data = {
        deleteIndex: index,
      };
      axios
        .post(this.apiUrl, JSON.stringify(data), {
          // headers è un oggetto che specifica che il contenuto inviato è un form
          // headers: { "Content-Type": "multipart/form-data" },
          // per inviare il valore booleano di task completa o no bisogna inviare un file json perchè il form ci strasforma il booleano in stringa
          headers: { "Content-Type": "application/json" },
        })
        .then((response) => {
          console.log(response.data);
          this.myList = response.data;
        });
    },

    // metodo per segnare le task completate mando la richiesta al server inviandogli anche l'indice della task cliccata per trasformare completed in true o false quando viene cliccata
    taskDone(index) {
      const data = {
        taskDoneIndex: index,
      };
      axios
        .post(this.apiUrl, JSON.stringify(data), {
          // headers è un oggetto che specifica che il contenuto inviato è un form
          // headers: { "Content-Type": "multipart/form-data" },
          // per inviare il valore booleano di task completa o no bisogna inviare un file json perchè il form ci strasforma il booleano in stringa
          headers: { "Content-Type": "application/json" },
        })
        .then((response) => {
          console.log(response.data);
          this.myList = response.data;
        });
    },

    //metodo per visualizzare la descrizione
    showDescription(index) {
      const data = {
        showDescriptionIndex: index,
      };
      axios
        .post(this.apiUrl, JSON.stringify(data), {
          // headers è un oggetto che specifica che il contenuto inviato è un form
          // headers: { "Content-Type": "multipart/form-data" },
          // per inviare il valore booleano di task completa o no bisogna inviare un file json perchè il form ci strasforma il booleano in stringa
          headers: { "Content-Type": "application/json" },
        })
        .then((response) => {
          if (response.data.redirectUrl) {
            // console.log(window.location);
            //window.location.href rappresenta l'URL attuale della pagina web in cui si trova l'utente quindi modificando href e inserendo il nuovo url ricevuto dalla richiesta del server vengo reindirizzato alla nuova pagina
            window.location.href = response.data.redirectUrl;
          }
        });
    },
  },
  mounted() {
    this.getRequest();
  },
}).mount("#app");
