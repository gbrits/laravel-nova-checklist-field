import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-checklist', IndexField)
  app.component('detail-checklist', DetailField)
  app.component('form-checklist', FormField)
})
