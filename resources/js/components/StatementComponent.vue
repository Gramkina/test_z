<template>
    <div v-for="statement in statements" class="p-6 bg-white border-b border-gray-200 mt-4 rounded-md" @click="showStatement" :statementid="statement.id">
        <div class="flex statement" v-if="showedStatement.id !== statement.id">
            <div>
                Заявка № {{ statement.id }} "{{ statement.name }}"
                <br>
                {{ statement.created_at }}
            </div>
            <img src="/img/icon/arrow.svg" alt="arrow.svg">
        </div>
        <div class="statement-info" v-else>
            <p class="statement-title">
                Заявка № {{ showedStatement.id }}   "{{ showedStatement.name }}"
            </p>
            <p>
                Номер телефона: 8{{ showedStatement.phone }}
            </p>
            <p>
                Компания: {{ showedStatement.company }}
            </p>
            <div v-if="showedStatement.file != null" class="statement-file">
                Прикрепленный файл:
                <a v-bind:href="showurl + '/' + showedStatement.id + '/download/'+ showedStatement.file.tmp_name" class="file-div" target="_blank">
                    {{ showedStatement.file.name }}
                </a>
            </div>
            <p>
                Сообщение:
            </p>
            <div class="statement-message">
                {{ showedStatement.message }}
            </div>
            <p class="created-statement">
                {{ showedStatement.created_at }}
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showedStatement: {
                },
            }
        },
        props: ['statements', 'showurl'],
        methods:{
            showStatement(event){
                axios.get(this.$props.showurl + '/' + event.currentTarget.getAttribute('statementid'))
                    .then((response) => {
                        this.showedStatement = response.data;
                    })
            },
        }
    }
</script>
