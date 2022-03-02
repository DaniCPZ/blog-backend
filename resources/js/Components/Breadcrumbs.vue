<template>
  <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    <span v-for="(item, index) in items" :key="index">
      <Link v-if="item.url" :href="item.url">{{
        item.label
      }}</Link>
      <span v-else class="text-gray-500">{{ item.label }}</span>
      <span v-if="index < items.length - 1" class="mx-2">&gt;</span>
    </span>
  </h2>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props: {
    items: {
      type: Array,
      required: true,
    },
  },
  components: {
    Link
  },
  data() {
    return {};
  },
  computed: {},
  methods: {},
  watch: {},
  mounted() {},
};
</script>