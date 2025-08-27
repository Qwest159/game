<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import tableau_att_coul from "@/Components/CouleurAttaque.vue";
import tableau_niv_coul from "@/Components/CouleurNiveau.vue";
import tableau_att_faibl from "@/Components/AttaqueFaiblesse.vue";

import { useForm } from "@inertiajs/vue3";
import { ref, defineProps, defineEmits } from "@vue/runtime-core";

const emit = defineEmits(["carte_info", "gain_gagne_combat"]);

const props = defineProps([
    "hero_user",
    "attaques_user",
    "niveau_bataille",
    "tableau_monstre_carte",
]);

let texte = ref([]);
let open_attaque = ref(false);
let open_sac = ref(false);

let attaque_choisi = ref(-1);
let exp_gagne_total = 0;
let hp_hero = ref(props.hero_user.hp_restant);

// let attaque_choisi = ref(1);
// let form = useForm({});
let tableau_combat_monstre = ref(props.tableau_monstre_carte.monstre_choisi);

function message_hero(att_restant, monstre_choisi) {
    texte.value[0] = `Héro `;
    texte.value[1] = `${
        att_restant > 0
            ? `Franchit la défense et attaque avec : ${att_restant}`
            : `Défense réussie du monstre`
    },`;
    texte.value[2] = ` ${
        monstre_choisi.hp > 0
            ? `HP du monstre: ${monstre_choisi.hp}`
            : "Mort du monstre"
    }`;
    // setTimeout(() => {
    //     texte.value = [];
    // }, 3000);
}
let message_attente = [];
function message_monstre(att_restant, hp_hero, index) {
    message_attente[index] = `Monstre : `;
    message_attente[index] += `${
        att_restant > 0
            ? ` Attaque subie: ${att_restant},`
            : ` La défense est réussie `
    }`;
    message_attente[index] += ` ${
        hp_hero > 0 ? `HP restant: ${hp_hero}` : "Mort du héro"
    }`;
    setTimeout(() => {
        texte.value = message_attente;
    }, 2000);
    setTimeout(() => {
        message_attente = [];
        texte.value = [];
    }, 5000);
}

function combat(index_monstre_choisi) {
    // ----DONNEE ----
    texte.value = [];
    let monstre_choisi = tableau_combat_monstre.value[index_monstre_choisi];
    let hero_caract = props.hero_user.caract_hero;

    combat_hero(
        hero_caract,
        attaque_choisi,
        monstre_choisi,
        index_monstre_choisi
    );
    // ----RESULTAT----

    // Condition de victoire (tous les monstre tués)
    // ----------GAGNER--------
    if (Object.keys(tableau_combat_monstre.value).length === 0) {
        // console.log("GAGNER");

        emit("carte_info", {
            index: props.niveau_bataille[1],
            img: props.niveau_bataille[0].img_path,
            montrer_bataille: null,
        });
        emit("gain_gagne_combat", {
            hp_restant: hp_hero.value,
            gain_gagne: { or: exp_gagne_total, exp: exp_gagne_total },
        });
    }

    // ----partie monstre ------
    hp_hero.value = combat_monstre(
        hero_caract.def,
        hp_hero.value,
        tableau_combat_monstre.value
    );

    // -----------remise par défaut les options du joueur----------
    attaque_choisi.value = -1;

    // ----------ATTAQUE DU MONSTRE ------------
    // Condition pour perdre (hp du hero en dessous de 0)

    if (hp_hero.value <= 0) {
        // console.log("PERDU");
        emit("gain_gagne_combat", {
            hp_restant: hp_hero.value,
            gain_gagne: { or: 0, exp: 0 },
        });
        emit("carte_info", {
            index: props.niveau_bataille[1],
            img: "outside/mystere.png",
            montrer_bataille: false,
        });
    }
}

// --------------- FUNCTION POUR COMBAT ------------
function combat_hero(
    hero_caract,
    attaque_choisi,
    monstre_choisi,
    index_monstre_choisi
) {
    // ----COMBAT DU HERO----
    let attaque_faiblesse = 0;
    // FAIBLESSE du monstre
    tableau_att_faibl[monstre_choisi.type] === attaque_choisi.value.type
        ? (attaque_faiblesse = attaque_choisi.value.att * 2)
        : (attaque_faiblesse = attaque_choisi.value.att);

    // let attaque_totale = hero_caract.att + attaque_faiblesse;
    let attaque_totale = 999;

    let att_restant = attaque_totale - monstre_choisi.def;

    if (att_restant > 0) {
        monstre_choisi.hp -= att_restant;
    }

    if (monstre_choisi.hp <= 0) {
        exp_gagne_total +=
            tableau_combat_monstre.value[index_monstre_choisi].exp;
        delete tableau_combat_monstre.value[index_monstre_choisi];
    }

    message_hero(att_restant, monstre_choisi);
}

function combat_monstre(def_hero, hp_hero, tableau_monstre) {
    Object.values(tableau_monstre).forEach((monstre, index) => {
        let att_restant = monstre.att - def_hero;
        // let att_restant = 0;
        if (att_restant > 0) {
            hp_hero -= att_restant;
        }

        message_monstre(att_restant, hp_hero, index);

        if (hp_hero <= 0) {
            return (hp_hero = 0);
        }
    });
    return hp_hero;
}
function fuite() {
    emit("gain_gagne_combat", {
        hp_restant: hp_hero.value,
        gain_gagne: { or: exp_gagne_total, exp: exp_gagne_total },
    });
    emit("carte_info", {
        index: props.niveau_bataille[1],
        img: "outside/mystere.png",
        montrer_bataille: false,
    });
}
</script>

<template>
    <section id="combat" class="h-full w-full absolute bg-black top-0">
        <article id="info_hero" class="absolute left-10 top-16">
            <figure class="">
                <img
                    class="rounded-t-xl w-full"
                    :src="`/storage${hero_user.portrait}`"
                    alt=""
                />
                <!-- <div class="bg-white p-2">
                    <h1>GAIN TOTAL</h1>
                    <p>exp :{{ exp_gagne_total }}</p>
                </div> -->
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
                                    {{ hp_hero }}
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
            </figure>
        </article>

        <figure id="arene_combat" class="m-auto relative pt-11">
            <img
                class="w-full"
                :src="`storage${props.niveau_bataille[0].img_path}`"
                alt=""
            />
            <img id="hero" :src="`storage${props.hero_user.img_path}`" alt="" />
            <div
                v-for="(monstre, index) in props.tableau_monstre_carte
                    .monstre_choisi"
            >
                <img
                    :src="`storage${monstre.img_path}`"
                    :id="`monstre${index}`"
                    class="monstre"
                    alt=""
                />
                <article
                    :id="`donnee_monstre${index}`"
                    :class="tableau_att_coul[monstre.type]"
                    class="info_monstre"
                >
                    <h3>Monstre {{ Number(index) + 1 }}</h3>
                    <div class="caract_monstre">
                        <p>HP: {{ monstre.hp }}</p>
                        <p>ATT: {{ monstre.att }}</p>
                        <p>DEF: {{ monstre.def }}</p>
                        <p>{{ monstre.type }}</p>
                    </div>
                </article>
            </div>
        </figure>
        <article id="barre_attaque" class="bg-gray-700 m-auto mt-2 p-1">
            <div
                v-if="attaque_choisi < 0 && !texte[0]"
                class="grid grid-cols-2"
            >
                <button @click="attaque_choisi = 0" class="bg-white">
                    Attaque</button
                ><button @click="open_sac = true" class="bg-white">Sac</button
                ><button class="bg-white">Truc</button
                ><button @click="fuite()" class="bg-white">Fuite</button>
            </div>
            <div
                v-if="attaque_choisi === 0"
                class="grid grid-cols-2 z-10 relative"
            >
                <button @click="attaque_choisi = -1" class="z-20 retour">
                    Retour
                </button>
                <button
                    v-for="attaque in attaques_user"
                    :class="tableau_att_coul[attaque.type]"
                    @click="attaque_choisi = attaque"
                >
                    {{ attaque.nom }}, {{ attaque.att }}
                </button>
            </div>
            <div
                v-if="attaque_choisi.att > 0"
                class="grid grid-cols-2 relative"
            >
                <button @click="attaque_choisi = -1" class="z-20 retour">
                    Retour
                </button>
                <button
                    class="flex bg-white justify-center"
                    v-for="(monstre, index) in tableau_combat_monstre"
                    @click="combat(index)"
                    :class="`button_choisi${index}`"
                >
                    <p>Monstre {{ Number(index) + 1 }}</p>
                    <img
                        :src="`storage${monstre.img_path}`"
                        class="monstre_choisi"
                        alt=""
                    />
                    <p class="pl-2">HP: {{ monstre.hp }}</p>
                </button>
            </div>
            <div id="message" v-if="texte">
                <p class="text-white" v-for="(textes, index) in texte">
                    {{ textes }}
                </p>
            </div>
        </article>

        <!-- <p
                id="croix"
                @click="montrer_disparait(), emit('ref_devis_disparait', false)"
            >
                ❌
            </p> -->
    </section>
</template>
