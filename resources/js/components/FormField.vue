<template>
  <field-wrapper>
    <div class="w-1/5 px-8 py-6">
      <slot>
        <form-label :for="field.name">
          {{ field.name }}
        </form-label>
      </slot>
    </div>
    <div class="w-4/5 px-8 py-6">
      <textarea
        :id="field.name"
        class="w-full form-control form-input form-input-bordered"
        :class="errorClasses"
        :placeholder="field.name"
        v-model="value"
      />

      <p v-if="hasError" class="my-2 text-danger">
        {{ firstError }}
      </p>
    </div>
  </field-wrapper>
</template>

<script>
import easyMDE from "easymde";
import { FormField, HandlesValidationErrors } from "laravel-nova";
require("easymde/dist/easymde.min.css");

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ["resourceName", "resourceId", "field"],

  data() {
    return {
      easymde: null,
    };
  },

  mounted() {
    this.easymde = new easyMDE({
      element: document.getElementById(this.field.name),
      spellChecker: false,
      hideIcons: ["image"],
      showIcons: ["table"],
    });

    if (this.field.value) {
      this.easymde.value(this.field.value);
    }

    this.easymde.codemirror.on("change", (cm, changeObj) => {
      this.value = this.easymde.value();
    });
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || "";
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || "");
    },

    /**
     * Update the field's internal value.
     */
    handleChange(value) {
      this.value = value;
    },
  },
};
</script>
