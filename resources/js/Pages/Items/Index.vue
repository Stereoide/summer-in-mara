<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Items
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div v-if="items.length === 0">No items created yet</div>

                    <div class="items" v-if="items.length !== 0">
                        <div class="item" v-for="(item, index) in items">
                            <a :href="route('items.edit', [item.id])">{{ item.name }}</a>
                        </div>
                    </div>

                    <p>
                        <button
                            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            <a :href="route('items.create')" class="btn">Add item</a>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

export default {
    props: [
        'items'
    ],

    components: {
        AppLayout,
    },

    data() {
        return {}
    },

    methods: {}
}
</script>
