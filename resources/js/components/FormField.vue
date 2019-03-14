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
import SimpleMDE from "simplemde";
import { FormField, HandlesValidationErrors } from "laravel-nova";
require("simplemde/dist/simplemde.min.css");

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ["resourceName", "resourceId", "field"],

  data() {
    return {
      simplemde: null,
    };
  },

  mounted() {
    this.simplemde = new SimpleMDE({
      spellChecker: false,
      hideIcons: ["image"],
    });

    if (this.field.value) {
      this.simplemde.value(this.field.value);
    }

    this.simplemde.codemirror.on("change", (cm, changeObj) => {
      this.value = this.simplemde.value();
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
