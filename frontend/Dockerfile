FROM node:22.19-alpine as build

WORKDIR /app

COPY package*.json ./
RUN npm install --frozen-lockfile

COPY . .

EXPOSE 5173

CMD ["npm", "run", "dev", "--host"]
