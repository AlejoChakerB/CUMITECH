IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='user_employees' AND xtype='U')
CREATE TABLE user_employees (
    id int IDENTITY(1,1) NOT NULL,
    id_user int NOT NULL,
    id_employees int NOT NULL,
    created_at datetime2(0) NULL,
    updated_at datetime2(0) NULL,
    deleted_at datetime2(0) NULL,
    CONSTRAINT PK_user_employees PRIMARY KEY (id)
);

CREATE INDEX user_employees_id_user_foreign ON user_employees (id_user);
CREATE INDEX user_employees_id_employees_foreign ON user_employees (id_employees);

ALTER TABLE user_employees
ADD CONSTRAINT FK_user_employees_id_employees FOREIGN KEY (id_employees) REFERENCES employes (id);

ALTER TABLE user_employees
ADD CONSTRAINT FK_user_employees_id_user FOREIGN KEY (id_user) REFERENCES users (id);

IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='presenters' AND xtype='U')
CREATE TABLE presenters (
    id int IDENTITY(1,1) NOT NULL,
    stand nvarchar(255) NOT NULL,
    qr_code nvarchar(max),
    id_users_employees int NOT NULL,
    created_at datetime2(0) NULL,
    updated_at datetime2(0) NULL,
    deleted_at datetime2(0) NULL,
    CONSTRAINT PK_presenters PRIMARY KEY (id)
);

CREATE INDEX presenters_id_users_employees_foreign ON presenters (id_users_employees);

ALTER TABLE presenters
ADD CONSTRAINT FK_presenters_id_users_employees FOREIGN KEY (id_users_employees) REFERENCES user_employees (id);


IF NOT EXISTS (SELECT * FROM sysobjects WHERE name='stand_assistances' AND xtype='U')
CREATE TABLE stand_assistances (
    id bigint IDENTITY(1,1) NOT NULL,
    stand nvarchar(255) NOT NULL,
    state nvarchar(255) NOT NULL,
    approved_date nvarchar(255) NULL,
    id_user_employees int NOT NULL,
    id_presenter int NOT NULL,
    created_at datetime2(0) NULL,
    updated_at datetime2(0) NULL,
    deleted_at datetime2(0) NULL,
    CONSTRAINT PK_stand_assistances PRIMARY KEY (id)
);

CREATE INDEX stand_assistances_id_user_employees_foreign ON stand_assistances (id_user_employees);
CREATE INDEX stand_assistances_id_presenter_foreign ON stand_assistances (id_presenter);

ALTER TABLE stand_assistances
ADD CONSTRAINT FK_stand_assistances_id_presenter FOREIGN KEY (id_presenter) REFERENCES presenters (id);

ALTER TABLE stand_assistances
ADD CONSTRAINT FK_stand_assistances_id_user_employees FOREIGN KEY (id_user_employees) REFERENCES user_employees (id);