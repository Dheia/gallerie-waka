<template>
    <span class="inline-flex items-center rounded-full bg-indigo-100 py-0.5 pl-2.5 pr-1 text-sm font-medium text-gray-700">
    <slot name="label">
        Fermer
    </slot>
    <button type="button" @click="$emit('clickOnBadge')" class="ml-0.5 inline-flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full text-gray-400 hover:bg-indigo-200 hover:text-gray-500 focus:bg-gray-500 focus:text-white focus:outline-none">
      <span class="sr-only">Close</span>
      <svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">
        <slot name="icone">
            <path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />
        </slot>
      </svg>
    </button>
  </span>
</template>