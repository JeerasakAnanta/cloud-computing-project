# Stage 1: Build the application
FROM node:18-alpine AS build

WORKDIR /usr/src/app

COPY package*.json ./

RUN npm install

COPY . .

# Stage 2: Create the final image
FROM node:18-alpine

WORKDIR /usr/src/app

COPY --from=build /usr/src/app .

EXPOSE 3001

CMD ["npm", "start"]
