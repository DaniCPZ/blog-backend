<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Settings
      </h2>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <UpdateHeroData :settings="settings" />
        <jet-section-border />
        <UpdateAboutData :settings="settings" />
        <jet-section-border />
        <UpdateContactData :settings="settings" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import UpdateHeroData from "./UpdateHeroData";
import UpdateAboutData from "./UpdateAboutData";
import UpdateContactData from "./UpdateContactData";
import JetSectionBorder from "../../Jetstream/SectionBorder";

export default {
  props: ["settings"],
  components: {
    AppLayout,
    UpdateHeroData,
    UpdateAboutData,
    UpdateContactData,
    JetSectionBorder,
  },
};
</script>