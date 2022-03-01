<template>
  <ckeditor :editor="editor"
            v-model="text"
            :config="editorConfig"></ckeditor>
</template>

<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
  props: {
    modelValue: {},
  },
  data() {
    return {
      text: "",
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
      },
    };
  },
  watch: {
    modelValue: {
      immediate: true,
      handler(modelValue) {
        this.text = modelValue;
      },
    },
    text(text) {
      this.$emit("update:modelValue", text);
    },
  },
};
</script>