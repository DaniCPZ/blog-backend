<template>
  <table>
    <thead>
      <tr>
        <th
          v-for="(header, index) in headers"
          :key="`header-${index}`"
          :class="header.class || 'text-left'"
        >
          {{ header.name }}
        </th>
      </tr>
    </thead>
    <tbody>
      <slot></slot>
      <tr v-if="items.data.length === 0" :colspan="headers.length">
        <div class="p-4">No data available</div>
      </tr>
    </tbody>
  </table>
  <div v-if="items.data.length > 0" class="mt-4">
    <SimplePagination
      :prev-url="items.links.prev"
      :next-url="items.links.next"
    />
  </div>
</template>

<script>
import SimplePagination from "./SimplePagination";

export default {
  props: {
    headers: {
      type: Array,
      required: true,
    },
    items: {
      type: Object,
      required: true,
    },
  },
  components: {
    SimplePagination,
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