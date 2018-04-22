<template>
  <div class="suite-dashboard">
    <md-layout md-column class="no-scroll">
      <md-layout md-gutter md-row>
        <md-layout md-flex="50" md-flex-gt-sm="20">
          <div class="layout media bg-1">
            <div class="media-header layout-column layout-align-center-center">
              <md-icon>account_balance</md-icon>
            </div>
            <div class="media-body layout-column layout-align-center-start">
              <p>组织</p>
              <h5>{{ media.orgs }}</h5>
            </div>
          </div>
        </md-layout>
        <md-layout md-flex="50" md-flex-gt-sm="20">
          <div class="layout media bg-2">
            <div class="media-header layout-column layout-align-center-center">
              <md-icon>donut_large</md-icon>
            </div>
            <div class="media-body layout-column layout-align-center-start">
              <p>阿米巴</p>
              <h5>{{ media.groups }}</h5>
            </div>
          </div>
        </md-layout>
        <md-layout md-flex="50" md-flex-gt-sm="20">
          <div class="layout media bg-3">
            <div class="media-header layout-column layout-align-center-center">
              <md-icon>account_circle</md-icon>
            </div>
            <div class="media-body layout-column layout-align-center-start">
              <p>用户</p>
              <h5>{{ media.users }}</h5>
            </div>
          </div>
        </md-layout>
        <md-layout md-flex="50" md-flex-gt-sm="20">
          <div class="layout media bg-4">
            <div class="media-header layout-column layout-align-center-center">
              <md-icon>access_time</md-icon>
            </div>
            <div class="media-body layout-column layout-align-center-start">
              <p>接口执行</p>
              <h5>{{ media.dti_time }}</h5>
            </div>
          </div>
        </md-layout>
        <md-layout md-flex="50" md-flex-gt-sm="20">
          <div class="layout media bg-5">
            <div class="media-header layout-column layout-align-center-center">
              <md-icon>timeline</md-icon>
            </div>
            <div class="media-body layout-column layout-align-center-start">
              <p>核算时间</p>
              <h5>{{ media.account_time }}</h5>
            </div>
          </div>
        </md-layout>
      </md-layout>
      <md-layout md-gutter md-row>
        <md-layout md-flex="100" md-flex-gt-sm="66">
          <md-card class="flex">
            <md-card-media>
              <md-chart class="myChart" ref="groupTrend"></md-chart>
            </md-card-media>
            <md-card-media>
              <md-layout md-gutter md-row>
                <md-layout md-flex-xs="100" md-flex-sm="50" md-flex="33">
                  <md-chart ref="groupStructure"></md-chart>
                </md-layout>
                <md-layout md-flex-xs="100" md-flex-sm="50" md-flex="66">
                  <md-chart ref="groupRank"></md-chart>
                </md-layout>
              </md-layout>
            </md-card-media>
          </md-card>
        </md-layout>
        <md-layout md-flex="100" md-flex-gt-sm="33">
          <md-card class="flex">
            <md-tabs md-fixed class="md-accent layout-fill">
              <md-tab md-label="资讯">
                <md-list class="md-double-line">
                  <template v-for="item in model.news">
                    <md-list-item>
                      <div class="md-list-item-text">
                        <span>{{ item.title }}</span>
                        <p>{{ item.summary }}</p>
                      </div>
                      <md-button class="md-icon-button md-list-action">
                        <md-icon class="md-primary">star</md-icon>
                      </md-button>
                    </md-list-item>
                    <md-divider></md-divider>
                  </template>
                </md-list>
              </md-tab>
              <md-tab md-label="法规">
                <md-list class="md-double-line">
                  <template v-for="item in model.statutes">
                    <md-list-item>
                      <div class="md-list-item-text">
                        <span>{{ item.title }}</span>
                        <p>{{ item.summary }}</p>
                      </div>
                      <md-button class="md-icon-button md-list-action">
                        <md-icon class="md-primary">star</md-icon>
                      </md-button>
                    </md-list-item>
                    <md-divider></md-divider>
                  </template>
                </md-list>
              </md-tab>
              <md-tab md-label="知识">
                <md-list class="md-double-line">
                  <template v-for="item in model.knowledges">
                    <md-list-item>
                      <div class="md-list-item-text">
                        <span>{{ item.title }}</span>
                        <p>{{ item.summary }}</p>
                      </div>
                      <md-button class="md-icon-button md-list-action">
                        <md-icon class="md-primary">star</md-icon>
                      </md-button>
                    </md-list-item>
                    <md-divider></md-divider>
                  </template>
                </md-list>
              </md-tab>
              <md-tab md-label="行情">
                <md-list class="md-dense">
                  <template v-for="item in model.prices">
                    <md-list-item>
                      <span>{{ item.title }}</span>
                      <span>{{ item.price }}</span>
                    </md-list-item>
                    <md-divider></md-divider>
                  </template>
                </md-list>
              </md-tab>
            </md-tabs>
          </md-card>
        </md-layout>
      </md-layout>
    </md-layout>
  </div>
</template>
<script>
import common from 'gmf/core/utils/common';
import _each from 'lodash/each'
export default {
  props: {},
  data() {
    return {
      model: {
        purpose: this.$root.configs.purpose,
        fm_period: null,
        to_period: null,
        groups: [],
        prices: [],
        news: [],
        knowledges: [],
        statutes: []
      },
      media: {
        orgs: 34,
        users: 15,
        groups: 3,
        account_time: '2018-04-02',
        dti_time: '2018-04-01'
      }
    };
  },
  watch: {
    'model.purpose': function(value) {
      this.loadData();
    },
    'model.fm_period': function(value) {
      this.loadData();
    },
    'model.to_period': function(value) {
      this.loadData();
    },
    'model.groups': function(value) {
      this.loadData();
    },
  },
  methods: {
    loadMedias() {
      this.$http.get('cbo/dashboards/media', { params: {} }).then(response => {
        this.media = response.data.data;
      }, response => {
        this.$toast(response);
      });
    },
    loadGroups() {
      this.$http.get('amiba/groups/all', { params: {} }).then(response => {
        this.model.groups = response.data.data;
      }, response => {
        this.$toast(response);
      });
      this.$http.get('amiba/reports/period-info').then(response => {
        this.model.fm_period = response.data.data.yearFirstPeriod;
        this.model.to_period = response.data.data.period;
      });
    },
    loadBecInfo() {
      this.$http.get('bec/posts', { params: { type: "news", pageSize: 5 } }).then(response => {
        this.model.news = response.data.data;
      }, response => {
        this.$toast(response);
      });
      this.$http.get('bec/posts', { params: { type: "knowledge", pageSize: 5 } }).then(response => {
        this.model.knowledges = response.data.data;
      }, response => {
        this.$toast(response);
      });
      this.$http.get('bec/posts', { params: { type: "statute", pageSize: 5 } }).then(response => {
        this.model.statutes = response.data.data;
      }, response => {
        this.$toast(response);
      });
      this.$http.get('bec/prices', { params: { pageSize: 12 } }).then(response => {
        this.model.prices = response.data.data;
      }, response => {
        this.$toast(response);
      });
    },
    loadData() {
      this.loadGroupRank();
      if (this.model.groups && this.model.groups.length > 0) {
        this.loadTroupTrend();
      } else {
        this.updateTroupTrend();
      }
      if (this.model.to_period && this.model.groups && this.model.groups.length > 0) {
        this.loadGroupStructure(this.model.to_period.id, this.model.groups[0].id);
      } else {
        this.updateGroupStructure();
      }
      this.loadMedias();
    },
    loadGroupRank() {
      var queryCase = { wheres: [] };
      if (this.model.purpose) {
        queryCase.wheres.push({ 'purpose_id': this.model.purpose.id });
      }
      if (this.model.fm_period) {
        queryCase.wheres.push({ 'period_id': this.model.fm_period.id });
      }
      this.$http.post('amiba/reports/group-rank-ans', queryCase).then(response => {
        this.updateGroupRank(response.data);
      }, response => {
        this.$toast(response);
      });
    },
    updateGroupRank(data) {
      var datas = [];
      if (data && data.data) {
        _each(data.data, (value, key) => {
          key < 10 && datas.push({
            name: value.name,
            y: value.this_profit
          });
        });
      }

      var opts = {
        chart: {
          type: 'column',
          //spacing: [0, 0, 0, 0],
          height: '180px'
        },
        colors: ['#46BFBD'],
        title: {
          text: ''
        },
        xAxis: {
          type: 'category',
          crosshair: true,
          allowDecimals: false,
          labels: { y: 20 }
        },
        yAxis: {
          title: { text: '' },
          offset: -10,
          allowDecimals: false,
          tickAmount: 5,
          labels: { padding: 0 },
          lineWidth: 1,
          gridLineWidth: 0
        },
        tooltip: { enabled: true, shared: true },
        plotOptions: {
          column: {
            groupPadding: 0.1,
            borderWidth: 0,
            dataLabels: { enabled: false },
          }
        },
        legend: { enabled: false },
        series: [{
          name: '利润',
          data: datas
        }]
      };
      this.$refs.groupRank && this.$refs.groupRank.mergeOption(opts);
    },
    loadGroupStructure(group_id, period_id) {
      var queryCase = { wheres: [] };
      if (this.model.purpose) {
        queryCase.wheres.push({ 'purpose_id': this.model.purpose.id });
      }
      if (period_id) {
        queryCase.wheres.push({ 'period_id': period_id });
      }
      if (group_id) {
        queryCase.wheres.push({ 'group_id': group_id });
      }
      this.$http.post('amiba/reports/group-structure-ans', queryCase).then(response => {
        this.updateGroupStructure(response.data);
      }, response => {
        this.$toast(response);
      });
    },
    updateGroupStructure(data) {
      var opts = {
        chart: {
          type: 'pie',
          spacing: [0, 0, 0, 0],
          margin: [0, 0, 0, 0],
          height: '200px'
        },
        title: { text: '', floating: true, align: 'center', verticalAlign: 'middle', },
        colors: ['#F7464A', '#46BFBD', '#FDB45C'],
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            borderWidth: 0,
            innerSize: '60%',
            shadow: false,
            center: ['50%', '50%'],
            dataLabels: {
              enabled: false
            },
            showInLegend: true,
            point: {
              events: {
                click(e) {
                  this.series.chart.setTitle({ text: this.name + '<br/>' + Math.round(this.percentage * 10) / 10 + '%' });
                }
              }
            },
          }
        },
        tooltip: { enabled: false },
        legend: {
          enabled: true,
          symbolRadius: 3,
          align: 'left',
          verticalAlign: 'middle',
          //floating: true,
          layout: "vertical"
        },
        series: [{
          type: 'pie',
          data: [
            { name: '收入', y: 20 },
            { name: '成本', y: 15 },
            { name: '利润', y: 5 },
          ]
        }]
      };
      this.$refs.groupStructure && this.$refs.groupStructure.mergeOption(opts);
    },
    loadTroupTrend(group_id) {
      var queryCase = { wheres: [] };
      if (this.model.purpose) {
        queryCase.wheres.push({ 'purpose_id': this.model.purpose.id });
      }
      if (this.model.fm_period) {
        queryCase.wheres.push({ 'gte': { 'fm_period': this.model.fm_period.code } });
      }
      if (this.model.to_period) {
        queryCase.wheres.push({ 'lte': { 'to_period': this.model.to_period.code } });
      }
      if (group_id) {
        queryCase.wheres.push({ 'group_id': group_id });
      }
      this.$http.post('amiba/reports/group-trend-ans', queryCase).then(response => {
        this.updateTroupTrend(response.data);
      }, response => {
        this.$toast(response);
      });
    },
    updateTroupTrend(data) {
      var categories = [];
      var datas1 = [];
      var datas2 = [];
      var datas3 = [];
      if (data && data.data) {
        _each(data.data, (value, key) => {
          categories.push(value.name);
          datas1.push({
            name: value.name,
            y: value.this_profit
          });
          datas2.push({
            name: value.name,
            y: value.this_income
          });
          datas3.push({
            name: value.name,
            y: value.this_cost
          });
        });
      }
      var opts = {
        chart: {
          type: 'areaspline',
          backgroundColor: "#00acc1",
        },
        title: {
          text: '趋势',
          align: 'left',
          style: { "color": "rgba(255,255,255,0.8)" }
        },
        colors: ['#27bbce', '#5dd0df'],
        legend: { enabled: false },
        xAxis: {
          title: {
            text: '',
          },
          type: 'category',
          labels: {
            style: { "color": "rgba(255,255,255,0.6)" }
          },
        },
        yAxis: {
          title: {
            text: '',
          },
          lineWidth: 1,
          lineColor: 'rgba(255,255,255,0.3)',
          tickAmount: 15,
          gridLineColor: 'rgba(255,255,255,0.3)',
          labels: {
            style: { "color": "rgba(255,255,255,0.6)" },
            formatter: function() {
              return this.value;
            }
          }
        },
        tooltip: {
          formatter: function() {
            return '<b>' + this.series.name + '</b><br/>' +
              this.x + ': ' + this.y;
          }
        },
        plotOptions: {
          areaspline: {
            marker: {
              lineWidth: 2,
              symbol: 'circle',
              radius: 3,
            },
            pointPlacement: 'on',
          }
        },
        series: [{
            name: '利润',
            data: datas1
          },
          // {
          //   name: '收入',
          //   data: datas2
          // }, {
          //   name: '成本',
          //   data: datas3
          // }
        ]
      }
      if (data && data.group) {
        opts.title.text = data.group.name + '趋势';
      }
      this.$refs.groupTrend && this.$refs.groupTrend.mergeOption(opts);
    },
  },
  created() {

  },
  mounted() {
    this.$nextTick(() => {
      this.loadGroups();
      this.loadBecInfo();
      this.loadData();
    });
  },
};
</script>
<style lang="scss" scoped>
.suite-dashboard {
  padding: 1.875rem;
}

.md-card {
  margin-bottom: 1.875rem;
  width: 100%;
}

.md-card-media {
  overflow: hidden;
}

.media {
  min-height: 70px;
  margin-bottom: 1.875rem;
  color: white;
  width: 100%;
  .media-header,
  .media-body {
    padding: 0px 16px;
  }
  .media-header {
    .md-icon {
      font-size: 50px;
      color: white;
      width: 50px;
      height: 50px;
    }
  }
  .media-body {
    flex: 1;
    font-size: 15px;
    h4,
    h5,
    p {
      margin: 0px;
    }
  }
  &.bg-1 {
    .media-header {
      background-color: #00A5A8;
    }
    .media-body {
      background-image: linear-gradient(to right, #00A5A8 0, #4DCBCD 100%);
    }
  }
  &.bg-2 {
    .media-header {
      background-color: #FF6275;
    }
    .media-body {
      background-image: linear-gradient(to right, #FF6275 0, #FF9EAC 100%);
    }
  }
  &.bg-3 {
    .media-header {
      background-color: #FF976A;
    }
    .media-body {
      background-image: linear-gradient(to right, #FF976A 0, #FFC2A4 100%);
    }
  }
  &.bg-4 {
    .media-header {
      background-color: #10C888;
    }
    .media-body {
      background-image: linear-gradient(to right, #10C888 0, #5CE0B8 100%);
      ;
    }
  }
  &.bg-5 {
    .media-header {
      background-color: #2196F3;
    }
    .media-body {
      background-image: linear-gradient(to right, #2196F3 0, rgba(33, 150, 243, .8) 100%);
    }
  }
}
</style>