<template>
  <jet-form-section @submitted="updateHeroInformation">
    <template #title> Hero Information </template>

    <template #description> Update the hero section data. </template>

    <template #form>
      <!--  Photo -->
      <div
        class="col-span-6 sm:col-span-6"
        v-if="$page.props.jetstream.managesProfilePhotos"
      >
        <AppImage
          :image-url="settings.data.hero_image_url"
          label="Photo"
          :error-message="form.errors.hero_image"
          v-model="form.hero_image"
        />
      </div>

      <!-- description -->
      <div class="col-span-6 sm:col-span-6">
        <jet-label for="description" value="Description" />
        <AppTextarea
          id="description"
          type="text"
          class="mt-1 block w-full"
          v-model="form.hero_description"
          autocomplete="description"
        />
        <jet-input-error
          :message="form.errors.hero_description"
          class="mt-2"
        />
      </div>
    </template>

    <template #actions>
      <jet-action-message :on="form.recentlySuccessful" class="mr-3">
        Saved.
      </jet-action-message>

      <jet-button
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
      >
        Save
      </jet-button>
    </template>
  </jet-form-section>
</template>

<script>
import JetButton from "../../Jetstream/Button.vue";
import JetFormSection from "../../Jetstream/FormSection.vue";
import JetInput from "../../Jetstream/Input.vue";
import JetInputError from "../../Jetstream/InputError.vue";
import JetLabel from "../../Jetstream/Label.vue";
import JetActionMessage from "../../Jetstream/ActionMessage.vue";
import JetSecondaryButton from "../../Jetstream/SecondaryButton.vue";
import AppTextarea from "../../Components/Textarea.vue";
import AppImage from "../../Components/Image.vue";
export default {
  components: {
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    AppTextarea,
    AppImage,
  },
  props: ["settings"],
  data() {
    return {
      form: this.$inertia.form(
        {
          hero_description: this.settings.data.hero_description,
          hero_image: null,
        },
        {
          resetOnSuccess: false,
        }
      ),
    };
  },
  methods: {
    updateHeroInformation() {
      this.form.post(route("settings.save-hero"), {
        preserveScroll: true,
      });
    },
  },
};
</script>