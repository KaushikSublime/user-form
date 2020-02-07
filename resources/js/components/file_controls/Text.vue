<template>
    <div id="text-control">
        <b-form-group id="input-group-2" :label="lblName" :label-for="id">
            <b-form-input
                :id="id"
                v-model="val"
                :required="isRequired"
                @focus="getInputValue"
            ></b-form-input>
        </b-form-group>
    </div>
</template>
<script>
export default {
    id: "text-control",
    data() {
        return {
            val: ""
        };
    },
    props: {
        lblName: {
            type: String,
            default: "Name"
        },
        id: {
            type: String,
            default: "txt_name"
        },
        isRequired: {
            type: Boolean,
            default: false
        }
    },
    methods: {
        getInputValue() {
            console.log(this.val);
            this.$emit("get-input-val", this.val);
        }
    }
};
</script>
