<template>
    <div>
        <b-container class="margin-top:20px">
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                <text-component lblName="Username" id="txtName" />
                <b-form-group
                    id="input-group-1"
                    label="Email:"
                    label-for="input-1"
                >
                    <b-form-input
                        id="input-1"
                        v-model="form.email"
                        type="email"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    id="input-group-2"
                    label="Phone Number:"
                    label-for="input-2"
                >
                    <b-form-input
                        id="input-2"
                        v-model="form.phone"
                        required
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-2"
                    label="Address:"
                    label-for="input-2"
                >
                    <b-form-textarea
                        id="textarea-default"
                        required
                        v-model="form.address"
                    ></b-form-textarea>
                </b-form-group>
                <b-form-group
                    id="input-group-2"
                    label="Your Zipcode:"
                    label-for="input-2"
                >
                    <b-form-input
                        id="input-2"
                        v-model="form.zip_code"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    id="input-group-2"
                    label="User Photo"
                    label-for="file-default"
                >
                    <b-form-file id="file-default"></b-form-file>
                </b-form-group>
                <b-button type="submit" variant="primary">Submit</b-button>
                <b-button type="reset" variant="danger">Reset</b-button>
            </b-form>
        </b-container>
    </div>
</template>

<script>
import TextComponent from "./file_controls/Text.vue";
export default {
    data() {
        return {
            form: {
                name: "",
                email: "",
                phone_number: "",
                address: "",
                zip_code: ""
            },
            show: true
        };
    },
    components: {
        TextComponent
    },
    methods: {
        onSubmit(evt) {
            evt.preventDefault();
            alert(JSON.stringify(this.form));
        },
        onReset(evt) {
            evt.preventDefault();
            // Reset our form values
            this.form.email = "";
            this.form.name = "";
            this.form.food = null;
            this.form.checked = [];
            // Trick to reset/clear native browser form validation state
            this.show = false;
            this.$nextTick(() => {
                this.show = true;
            });
        }
    }
};
</script>
