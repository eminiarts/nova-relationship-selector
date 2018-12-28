<template>
  <div class="relationship-selector" v-if="field.options.length">
    <div class="mb-3" v-if="!field.extraAttributes || !field.extraAttributes.withSelect">
      <select
        v-model="activeTab"
        class="form-select shadow-none border-0 text-90 font-normal text-2xl bg-transparent py-2 pl-0 focus:border-0 focus:outline-none focus:shadow-none"
        :class="{'only-one-option': field.options.length == 1}"
      >
        <option
          v-for="(tab, key) in options"
          :key="key"
          :value="tab.name"
          class="text-base"
        >&nbsp;{{ tab.name }}</option>
      </select>
    </div>
    <div
      class="mb-3 flex items-center"
      v-if="field.extraAttributes && field.extraAttributes.withSelect"
    >
      <h1 class="text-90 font-normal text-2xl flex-no-shrink">{{ activeTab }}</h1>
      <div class="ml-3 w-full flex items-center"></div>
      <select v-model="activeTab" class="form-control form-select">
        <option v-for="(tab, key) in options" :key="key" :value="tab.name">{{ tab.name }}</option>
      </select>
    </div>
    <div class="relationship-selector-content">
      <div
        v-for="(tab, index) in options"
        v-if="tab.name == activeTab"
        :label="tab.name || tab.field.resourceName.toLocaleUpperCase()"
        :key="'related-options-fields' + index"
        :name="tab.field.resourceName"
      >
        <component
          :is="'detail-' + tab.field.component"
          :resource-name="resourceName"
          :resource-id="resourceId"
          :resource="resource"
          :field="tab.field"
          @actionExecuted="actionExecuted"
        />
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["resource", "resourceName", "resourceId", "field"],
  data() {
    return {
      options: null,
      activeTab: ""
    };
  },
  mounted() {
    this.options = this.field.options;
    this.activeTab = this.options[0].name;
  },
  methods: {
    /**
     * Handle the actionExecuted event and pass it up the chain.
     */
    actionExecuted() {
      this.$emit("actionExecuted");
    },
    handleTabClick(tab, event) {}
  }
};
</script>

<style lang="scss">
.relationship-selector {
  .relationship-selector-content {
    min-height: 355px;
  }
  .form-select.only-one-option {
    background-image: none;
    pointer-events: none;
  }
  .form-select {
    text-indent: -5px;
  }
  .form-select:focus {
    outline: none;
    -webkit-box-shadow: none;
    box-shadow: none;
  }
}
.relationship-selector-content {
  h1 {
    display: none;
  }
}
</style>