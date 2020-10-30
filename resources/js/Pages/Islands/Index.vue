<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Islands
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div v-if="islands.length === 0">No islands created yet</div>

                    <div class="islands" v-if="islands.length !== 0">
                        <div class="island" v-for="(island, index) in islands">
                            <a :href="route('islands.edit', [island.id])">{{ island.name }}</a>
                        </div>
                    </div>

                    <p>
                        <button
                            class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                            <a :href="route('islands.create')" class="btn">Add island</a>
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
        'islands'
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
