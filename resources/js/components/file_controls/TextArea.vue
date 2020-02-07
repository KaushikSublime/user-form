<template>
    <div id="text-area">
        <b-form-group id="input-group-2" :label="lblName" :label-for="id">
            <b-form-textarea
                :id="id"
                v-model="val"
                :required="isRequired"
                @blur="getInputValue"
            ></b-form-textarea>
        </b-form-group>
    </div>
</template>
<script>
export default {
    id: "text-area",
    data() {
        return {
            val: ""
        };
    },
    props: {
        lblName: {
            type: String,
            default: "Name",
            required: true
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
            this.$emit("getInputVal", { val: this.val, type: this.lblName });
        }
    }
};
</script>
