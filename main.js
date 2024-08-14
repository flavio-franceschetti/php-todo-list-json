const { createApp } = Vue;

createApp({
  data() {
    return {
      // dati utili
      apiUrl: "server.php",
      myList: [],
      userInput: "",
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
        },
      };

      axios
        .post(this.apiUrl, data, {
          // headers è un oggetto che specifica che il contenuto inviato è un form
          headers: { "Content-Type": "multipart/form-data" },
        })
        .then((response) => {
          console.log(response.data);
          this.myList = response.data;
        });
    },
  },
  mounted() {
    this.getRequest();
  },
}).mount("#app");
