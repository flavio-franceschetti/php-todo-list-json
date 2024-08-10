const { createApp } = Vue;

createApp({
  data() {
    return {
      // dati utili
      apiUrl: "server.php",
      myList: [],
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
  },
  mounted() {
    this.getRequest();
  },
}).mount("#app");
