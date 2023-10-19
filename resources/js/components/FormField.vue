<template>
  <default-field
      :field="field"
      :errors="errors"
      :show-errors="false"
      :full-width-content="true"
  >
      <template #field>
        <div v-if="templates && templates.length">
          Populate from Template <em>(Optional)</em>: <select style="border: 1px solid #cbd5e1;
          padding: 5px 10px;
          border-radius: 3px;
          width: 30%;
          background: #fbfbfb;" v-model="selectedTemplate" v-on:change="populateCriteria($event)"><option>Select</option><option v-for="template in templates" :key="template.id">{{ template.title }}</option></select>
        </div>
          <div class="w-full">
              <items :items="value" :field="field" :edit="true" v-on:added="handleChange" v-on:removed="handleChange" :key="itemsKey"></items>
              <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
              </p>
          </div>
      </template>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import Items from './Items.vue';

export default {
  mixins: [FormField, HandlesValidationErrors],
  components: {Items},
  props: ['resourceName', 'resourceId', 'field'],
  data() {
    return {
      itemsKey: 1,
      selectedTemplate: '',
      templates: {},
      selectedTemplateTitle: null,
      selectedTemplateId: null
    }
  },

  methods: {

      populateCriteria($event) {
        if (!this.templates) return;  // Skip if no templates

        const template = this.templates.find(t => t.title == this.selectedTemplate);
        if(template && 'criteria' in template) {
          this.selectedTemplateTitle = template.title;
          this.selectedTemplateId = template.id;
          this.field.value = template.criteria;
          this.value = JSON.parse(this.field.value) || [];
          this.itemsKey++;
        }
      },

      retrieveTemplates() {
          if (!this.field.endpoint) return;  // Skip if no endpoint set

          const that = this;
          Nova.request().get(this.field.endpoint).then(function (resp) {
              that.templates = resp.data;
          });
      },

      setInitialValue() {
          if (this.field.endpoint) {  // Only retrieve if endpoint exists
              this.retrieveTemplates();
          }
          this.value = JSON.parse(this.field.value) || [];
      },


      fill(formData) {
        

        if(this.selectedTemplateTitle) {
          Nova.success('Setting title to '+this.selectedTemplateTitle);
          this.fillIfVisible(formData, 'title', this.selectedTemplateTitle);
        }

        if(this.selectedTemplateId) {
          Nova.success('Setting template ID to '+this.selectedTemplateId);
          this.fillIfVisible(formData, 'template_id', parseInt(this.selectedTemplateId));
        }

        this.fillIfVisible(formData, this.field.attribute, JSON.stringify(this.value) || '')

      },

      handleChange(value) {
        this.value = value
      }
  },
}
</script>