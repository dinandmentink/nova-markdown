import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component("index-markdown", IndexField);
  app.component("detail-markdown", DetailField);
  app.component("form-markdown", FormField);
});
