<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import tableau_niv_coul from "@/Components/CouleurNiveau.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, defineProps, defineEmits } from "@vue/runtime-core";

// const emit = defineEmits(["mont"]);

const props = defineProps(["hero_user"]);

// let message_gain = ref([or]);

let message_gain = {};
</script>

<template>
    <AppLayout title="Exterieur">
        <main class="h-screen pt-16 bg-black" id="chateau">
            <section class="index_info_hero">
                <figure class="">
                    <img
                        class="w-full rounded-t-xl"
                        :src="`/storage${hero_user.portrait}`"
                        alt=""
                    />
                </figure>

                <table class="rounded-b-xl">
                    <tbody>
                        <tr class="non text-xl font m-auto pb-2">
                            <td class="">{{ hero_user.role }}</td>
                        </tr>
                        <tr class="non text-xl font pb-2 m-auto">
                            <td class="font-bold text-center">Niveau</td>
                            <td
                                :class="tableau_niv_coul[hero_user.niveau]"
                                id="niveau"
                            >
                                {{ hero_user.niveau }}
                            </td>
                        </tr>

                        <tr>
                            <td class="self-center">HP</td>
                            <td class="text-center">
                                <p class="border-b-2 border-black">
                                    {{ hero_user.hp_restant }}
                                </p>
                                <p>{{ hero_user.caract_hero.hp }}</p>
                            </td>
                        </tr>
                        <tr class="">
                            <td>ATT</td>
                            <td class="text-center">
                                {{ hero_user.caract_hero.att }}
                            </td>
                        </tr>
                        <tr>
                            <td>DEF</td>
                            <td class="text-center">
                                {{ hero_user.caract_hero.def }}
                            </td>
                        </tr>
                        <tr>
                            <td class="self-center">EXP</td>
                            <td class="text-center">
                                <p class="border-b-2 border-black">
                                    {{ hero_user.exp_restant }}
                                </p>

                                <p class="">
                                    {{ hero_user.caract_hero.exp_requis }}
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section class="grid grid-cols-3 relative">
                <p
                    v-if="message_afficher"
                    id="message_info"
                    class="bg-red-600 justify-self-center px-2 text-white font-extrabold text-2xl text-center absolute z-10 rounded-xl"
                >
                    {{ message_afficher }}
                </p>
            </section>
        </main>
    </AppLayout>
</template>
