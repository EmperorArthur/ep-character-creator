<template>
<!--    uk-text-center-->
    <div class="uk-child-width-expand@s" uk-grid>
        <div>
        <div class="uk-card uk-card-default uk-card-body">
<!--            <red-watermark>Firewall Classified (Top Secret)</red-watermark>-->
            <h3 class="uk-card-title">Player Information</h3>
            <span class="btnhelp slowTransition icon-question" :title="playerDescription"></span>
            <label>
                Player Name:
                <input type="text" class="uk-input">
            </label>
            <label>
                Notes:
                <textarea class="uk-textarea"></textarea>
            </label>
        </div>
        </div>
        <div>
        <div class="uk-card uk-card-default uk-card-body">
            Planetary Consortium Official Identification Card
            <i>fas image of a generic person (on left)</i>
            <form>
                <label>
                    Name
                    <input type="text" class="uk-input">
                </label>
                <label>
                    Age
                    <input type="text" class="uk-input">
                </label>
                <label>
                    Gender*
                    <input type="text" class="uk-input">
                </label>


            </form>
            <div class="postscript">
                * The Planetary Consortium recognizes the rights of all beings to choose their genders at will.
                Furthermore, the Consortium recognizes that an Ego may be sleeved in a morph different from their
                preferred gender.
                However, for the safety and security of all, this Ego generally identifies as the stated gender.
            </div>
            <div>
                Certificate of Credit

            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Ego",
        data: () => ({
            playerDescription: `
            Firewall has determined that this Ego may actually be a puppet of an entity, known as a "Player."
            Verry little is known about these entities, and under no circumstances should the entity become aware of our suspicions.
            These are the information we have managed to gleam about this particular "Player."
            `,
        }),
    }
</script>

<style scoped>

</style>