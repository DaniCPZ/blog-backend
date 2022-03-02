<template>
  <app-layout>
    <template #header>
      <Breadcrumbs :items="breadcrumbs" />
    </template>
    <Container>
      <Card>
        <form @submit.prevent="saveArticle">
          <AppImage
            class="mt-2"
            v-model="form.image"
            :image-url="imageUrl"
            label="Image"
            :error-message="form.errors.image"
          />

          <div class="mt-4">
            <jet-label for="category" value="Category" />

            <select
              name="category"
              id="category"
              class="block w-full form-input"
              v-model="form.category_id"
            >
              <option value="">Select</option>
              <option
                v-for="category in categories.data"
                :key="category.id"
                :value="category.id"
              >
                {{ category.name }}
              </option>
            </select>
            <jet-input-error :message="form.errors.category_id" class="mt-2" />
          </div>
          <div>
            <jet-label for="title" value="Title" />
            <jet-input
              id="title"
              type="text"
              class="mt-1 block w-full"
              v-model="form.title"
              autocomplete="title"
            />
            <jet-input-error :message="form.errors.title" class="mt-2" />
          </div>

          <!-- slug -->
          <div class="mt-4">
            <jet-label for="slug" value="Slug" />
            <jet-input
              id="slug"
              type="text"
              class="mt-1 block w-full"
              v-model="form.slug"
              autocomplete="slug"
            />
            <jet-input-error :message="form.errors.slug" class="mt-2" />
          </div>

          <div class="mt-4">
            <jet-label for="description" value="Description" />

            <AppCkeditor class="mt-1" v-model="form.description" />

            <jet-input-error :message="form.errors.description" class="mt-2" />
          </div>

          <div class="mt-4">
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
              <span v-if="edit">Updated.</span>
              <span v-else>Saved.</span>
            </jet-action-message>

            <jet-button
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
            >
              <span v-if="edit">Update</span>
              <span v-else>Save</span>
            </jet-button>
          </div>
        </form>
      </Card>
    </Container>
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout";
import JetButton from "../../Jetstream/Button";
import JetLabel from "../../Jetstream/Label";
import JetInput from "../../Jetstream/Input";
import JetInputError from "../../Jetstream/InputError";
import JetActionMessage from "../../Jetstream/ActionMessage";
import { strSlug } from "../../helpers.js";
import Container from "../../Components/Container.vue";
import Card from "../../Components/Card.vue";
import Breadcrumbs from "../../Components/Breadcrumbs";
import AppCkeditor from "../../Components/Ckeditor";
import AppImage from "../../Components/Image";

export default {
  components: {
    AppLayout,
    JetButton,
    JetLabel,
    JetInput,
    JetInputError,
    JetActionMessage,
    Container,
    Card,
    Breadcrumbs,
    AppCkeditor,
    AppImage,
  },
  props: {
    edit: Boolean,
    article: Object,
    categories: {
      type: Object,
      default: function () {
        return {
          data: [],
        };
      },
    },
  },
  data() {
    return {
      imageUrl: "",
      form: this.$inertia.form(
        {
          _method: this.edit ? "PUT" : "",
          category_id: "",
          title: "",
          slug: "",
          description: this.edit ? this.article.data.description : "",
          image: null,
        },
        {
          resetOnSuccess: false,
        }
      ),
    };
  },
  computed: {
    breadcrumbs() {
      return [
        {
          label: "Articles",
          url: route("articles.index"),
        },
        {
          label: `${this.edit ? "Edit" : "Add"} Article`,
        },
      ];
    },
  },
  methods: {
    saveArticle() {
      this.edit
        ? this.form.post(route("articles.update", { id: this.article.data.id }))
        : this.form.post(route("articles.store"));
    },
  },
  watch: {
    "form.title"(title) {
      this.form.slug = strSlug(title);
    },
  },
  mounted() {
    if (this.edit) {
      this.form.category_id = this.article.data.category_id;
      this.form.slug = this.article.data.slug;
      this.form.title = this.article.data.title;
    }
    this.imageUrl = this.article.data.image_url;
  },
};
</script>