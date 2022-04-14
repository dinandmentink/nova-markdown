<template>
  <PanelItem :index="index" :field="field">
    <template #value>
      <Excerpt :content="excerpt" :should-show="field.shouldShow" />
    </template>
  </PanelItem>
</template>

<script>
import md from 'markdown-it'

export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],

  computed: {
    excerpt() {
      return md(this.field.preset).render(this.field.value || '')
    },
  },
}
</script>
