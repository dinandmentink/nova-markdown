Nova.booting((Vue, router, store) => {
  Vue.component("index-markdown", require("./components/IndexField").default);
  Vue.component("detail-markdown", require("./components/DetailField").default);
  Vue.component("form-markdown", require("./components/FormField").default);
});
