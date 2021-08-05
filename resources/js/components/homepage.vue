<template>
  <div id="app">
    <div id="nav">
      <router-link to="/" class="has-text-success"
        >🐸 Have U Read This Tech</router-link
      >
      |
    </div>
    <div class="column pt-5 px-5">
      <div class="field is-grouped pb-3">
        <div class="control">
          <input
            class="input is-small"
            v-model="search"
            type="text"
            placeholder="Search"
          />
        </div>
        <div class="control">
          <button class="button is-small is-primary" v-on:click="get_list()">
            Search
            <main></main>
          </button>
        </div>
        <div class="control">
          <button
            class="button is-link is-small"
            @click="$router.push({ path: '/new' })"
          >
            New
            <main></main>
          </button>
        </div>
      </div>
      <div class="columns is-multiline is-mobile">
        <div class="column is-3" v-for="(item, index) in title" :key="index">
          <div class="card has-background-white-bis">
            <div class="card-content">
              <div class="content">
                <strong class="text-with-dots">🟢 {{ item["name"] }}</strong>
                <div class="block pt-3">
                  <a :href="item['link']" target="chart"
                    ><button class="button is-success is-small">
                      🎯 Direct to
                    </button></a
                  >
                  <button
                    class="button is-info is-small"
                    @click="
                      $router.push({
                        path: '/edit/' + item['id'],
                      })">
                    Edit
                  </button>
                  <button
                    class="button is-danger is-small"
                    @click="del(item['id'])"
                  >
                    Delete
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      search: "",
      title: [],
    };
  },
  created() {
    this.get_list();
  },
  methods: {
    get_list() {
      this.axios
        .get("/", {
          headers: {
            "Content-Type": "application/json",
          },
          params: {
            q: this.search,
          },
        })
        .then((res) => {
          this.title = res.data;
        })
        .catch(function (error) {
          console.log(error);
        });
    },
    del(id) {
      this.axios
        .delete("/" + id, {
          headers: {
            "Content-Type": "application/json",
          },
        })
        .then((res) => {
          this.get_list();
        })
        .catch(function (error) {
          console.log(error);
        });
    },
  },
};
</script>


<style>
@import url("https://fonts.googleapis.com/css2?family=Source+Code+Pro&display=swap");
hr {
  border: 0.5px;
  padding-top: 0px;
  padding-bottom: 0px;
  margin-top: 0px;
  margin-bottom: 0px;
}
#app {
  font-family: "Source Code Pro", monospace;
  font-size: 0.9em;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
#nav {
  padding: 15px;
}
#nav a {
  font-weight: bold;
  color: #2c3e50;
}
#nav a.router-link-exact-active {
  color: #42b983;
}
</style>
