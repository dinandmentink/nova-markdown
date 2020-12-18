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
import $ from "jquery";
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
    function renameFile(originalFile, newName) {
      return new File([originalFile], newName, {
        type: originalFile.type,
        lastModified: originalFile.lastModified,
      });
    }

    var csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    var imageUpload = this.field.uploads;
    var imageUploadEndpoint = this.field.uploadEndpoint;
    var maxSize = this.field.maxSize * 1024;

    var errorMessages = {
      noFileGiven: "You must select a file.",
      typeNotAllowed: "This image type is not allowed.",
      fileTooLarge:
        "Image #image_name# is too big (#image_size#). Maximum file size is " +
        maxSize / 1024 +
        "kb.",
      importError:
        "Something went wrong when uploading the image #image_name#.",
    };

    this.easymde = new easyMDE({
      element: document.getElementById(this.field.name),
      spellChecker: false,
      hideIcons: ["image"],
      showIcons: ["table"],
      uploadImage: imageUpload,
      imageUploadFunction: function (file, onSuccess, onError) {
        if (file.size > maxSize) {
          return onError(errorMessages.fileTooLarge);
        }

        // File is copy/pasted, rename it
        if (file.name == "image.png") {
          file = renameFile(file, new Date().toISOString() + ".png");
        }

        var formData = new FormData();
        formData.append("_token", csrfToken);
        formData.append("image", file);

        $.ajax(imageUploadEndpoint, {
          data: formData,
          type: "POST",
          contentType: false,
          processData: false,
        })
          .done(function (data) {
            if (data && data.url) {
              return onSuccess(data.url);
            } else {
              return onError(errorMessages.importError);
            }
          })
          .fail(function (data) {
            return onError(errorMessages.importError);
          });
      },
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
